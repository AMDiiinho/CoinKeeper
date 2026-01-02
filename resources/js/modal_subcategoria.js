// modal_subcategoria.js
// Cria subcategoria via AJAX e dispara evento customizado 'subcategoria:created' com os dados retornados.

document.addEventListener('DOMContentLoaded', function () {
  const criaSubcategoriaBtn = document.getElementById('criaSubCategoria');
  const cancelaSubcategoriaBtn = document.getElementById('cancelSubcategoria');
  const modalTitle = document.getElementById('modalTitle');
  const originalTitle = modalTitle ? modalTitle.textContent : '';

  const formTransacao = document.getElementById('formTransacao');
  const formSubcategoria = document.getElementById('formSubcategoria');

  const mainCategoriaSelect = document.getElementById('categoria');

  // Select visual do modal (apenas exibição) e hidden que será enviado
  let modalCategoriaSelect = document.getElementById('categoriaSelectSubcategoria');
  if (modalCategoriaSelect && modalCategoriaSelect.tagName !== 'SELECT') {
    const inner = modalCategoriaSelect.querySelector('select');
    if (inner) modalCategoriaSelect = inner;
  }
  if (!modalCategoriaSelect) {
    modalCategoriaSelect = document.querySelector('#formSubcategoria select[name="categoria_display"]');
  }
  const modalInputHidden = document.getElementById('input-categoria-hidden');

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  if (!formTransacao || !formSubcategoria) {
    console.warn('formTransacao ou formSubcategoria não encontrados. Script abortado.');
    return;
  }

  function sincronizaCategoriaNoModal() {
    if (!modalInputHidden) {
      console.warn('input-categoria-hidden não encontrado.');
      return;
    }

    if (!mainCategoriaSelect || !mainCategoriaSelect.value) {
      if (modalCategoriaSelect) {
        modalCategoriaSelect.innerHTML = '';
        modalCategoriaSelect.add(new Option('Nenhuma categoria selecionada', '', false, false));
        modalCategoriaSelect.disabled = true;
      }
      modalInputHidden.value = '';
      return;
    }

    const selectedOption = mainCategoriaSelect.options[mainCategoriaSelect.selectedIndex];
    const idCategoria = selectedOption.value;
    const nomeCategoria = selectedOption.text;

    if (modalCategoriaSelect) {
      modalCategoriaSelect.innerHTML = '';
      modalCategoriaSelect.add(new Option(nomeCategoria, idCategoria, true, true));
      modalCategoriaSelect.value = idCategoria;
      modalCategoriaSelect.disabled = true;
      modalCategoriaSelect.dispatchEvent(new Event('change', { bubbles: true }));
    }

    modalInputHidden.value = idCategoria;
  }

  if (criaSubcategoriaBtn) {
    criaSubcategoriaBtn.addEventListener('click', function (e) {
      e.preventDefault();
      sincronizaCategoriaNoModal();
      formTransacao.style.display = 'none';
      formSubcategoria.style.display = 'block';
      if (modalTitle) modalTitle.textContent = 'Nova Sub-categoria';
    });
  }

  if (cancelaSubcategoriaBtn) {
    cancelaSubcategoriaBtn.addEventListener('click', function (e) {
      e.preventDefault();
      formSubcategoria.reset();
      if (modalInputHidden) modalInputHidden.value = '';
      if (modalCategoriaSelect) {
        modalCategoriaSelect.innerHTML = '';
        modalCategoriaSelect.add(new Option('Selecione...', '', false, false));
        modalCategoriaSelect.disabled = true;
      }
      formSubcategoria.style.display = 'none';
      formTransacao.style.display = 'block';
      if (modalTitle) modalTitle.textContent = originalTitle;
    });
  }

  // Submit do formSubcategoria via AJAX: cria e dispara evento com o resultado
  formSubcategoria.addEventListener('submit', async function (e) {
    e.preventDefault();

    const url = formSubcategoria.getAttribute('action');
    const formData = new FormData(formSubcategoria);

    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: formData,
        credentials: 'same-origin'
      });

      const data = await res.json().catch(() => null);

      if (!res.ok || !data) {
        const message = data?.message || 'Erro ao criar subcategoria';
        alert(message);
        console.log('Erros:', data?.errors || data);
        return;
      }

      // Dispara evento global com os dados da subcategoria criada
      const event = new CustomEvent('subcategoria:created', {
        detail: {
          id: data.id,
          nome: data.nome,
          categoria_id: data.categoria_id ?? formData.get('categoria-subcategoria') ?? modalInputHidden?.value
        }
      });
      document.dispatchEvent(event);

      // Fecha modal e reabre formTransacao (UI local)
      formSubcategoria.reset();
      if (modalInputHidden) modalInputHidden.value = '';
      if (modalCategoriaSelect) {
        modalCategoriaSelect.innerHTML = '';
        modalCategoriaSelect.add(new Option('Selecione...', '', false, false));
        modalCategoriaSelect.disabled = true;
      }
      formSubcategoria.style.display = 'none';
      formTransacao.style.display = 'block';
      if (modalTitle) modalTitle.textContent = originalTitle;

    } catch (err) {
      console.error('Erro de rede ao criar subcategoria:', err);
      alert('Erro de rede ao criar subcategoria');
    }
  });
});
