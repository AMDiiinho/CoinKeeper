// modal_transacoes.js
// Responsável por repopular subcategorias quando a categoria muda
// e por reagir ao evento 'subcategoria:created' para selecionar a nova subcategoria.

document.addEventListener('DOMContentLoaded', () => {
  const modalCreateTransacao = document.getElementById('modalCreateTransacao');
  const lancamentoSelect = document.querySelector('[name="lancamento"]');
  const formTransacao = document.getElementById('formTransacao');
  const recorrenciaPer = document.getElementById('recorrenciaPer');
  const recorrenciaQtd = document.getElementById('recorrenciaQtd');
  const categoriaSelect = document.getElementById('categoria');
  const criaSubcategoriaBtn = document.getElementById('criaSubCategoria');
  const subcategoriaSelect = document.getElementById('subcategoria');

  // segurança
  if (!categoriaSelect || !subcategoriaSelect) {
    console.warn('categoria ou subcategoria select não encontrados. Script abortado.');
    return;
  }

  // Função que busca subcategorias por categoria e popula o select de subcategoria
  async function repopulaSubcategorias(categoriaId, selectedSubcategoriaId = null) {
    if (!subcategoriaSelect) return;

    subcategoriaSelect.disabled = true;
    subcategoriaSelect.innerHTML = '';
    subcategoriaSelect.add(new Option('Carregando...', '', false, false));

    try {
      const url = `/subcategorias?categoria_id=${encodeURIComponent(categoriaId || '')}`;
      const resp = await fetch(url, {
        method: 'GET',
        headers: { 'Accept': 'application/json' },
        credentials: 'same-origin'
      });

      if (!resp.ok) {
        console.error('Erro ao buscar subcategorias', resp.status);
        subcategoriaSelect.innerHTML = '';
        subcategoriaSelect.add(new Option('Erro ao carregar', '', false, false));
        return;
      }

      const lista = await resp.json();

      subcategoriaSelect.innerHTML = '';
      if (!lista.length) {
        subcategoriaSelect.add(new Option('Nenhuma subcategoria', '', false, false));
        subcategoriaSelect.value = '';
      } else {
        lista.forEach(s => subcategoriaSelect.add(new Option(s.nome, String(s.id), false, false)));

        if (selectedSubcategoriaId) {
          subcategoriaSelect.value = String(selectedSubcategoriaId);
          if (subcategoriaSelect.value !== String(selectedSubcategoriaId)) {
            console.warn('Subcategoria selecionada não encontrada:', selectedSubcategoriaId);
          }
        }
      }
    } catch (err) {
      console.error('Erro ao repopular subcategorias:', err);
      subcategoriaSelect.innerHTML = '';
      subcategoriaSelect.add(new Option('Erro ao carregar', '', false, false));
    } finally {
      subcategoriaSelect.disabled = false;
      subcategoriaSelect.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  // Habilita/desabilita botão e select de subcategoria conforme categoria
  categoriaSelect.addEventListener('change', function () {
    if (this.value === '') {
      subcategoriaSelect.disabled = true;
      criaSubcategoriaBtn.disabled = true;
      subcategoriaSelect.style.cursor = 'not-allowed';
      criaSubcategoriaBtn.style.cursor = 'not-allowed';
      // limpa opções
      subcategoriaSelect.innerHTML = '';
      subcategoriaSelect.add(new Option('Selecione uma categoria', '', false, false));
    } else {
      subcategoriaSelect.disabled = false;
      criaSubcategoriaBtn.disabled = false;
      subcategoriaSelect.style.cursor = 'pointer';
      criaSubcategoriaBtn.style.cursor = 'pointer';
      // repopula subcategorias para a categoria selecionada
      repopulaSubcategorias(this.value, null);
    }
  });

  // inicializa subcategorias ao carregar a página (se já houver categoria selecionada)
  if (categoriaSelect.value) {
    repopulaSubcategorias(categoriaSelect.value, subcategoriaSelect?.value || null);
  } else {
    // placeholder inicial
    subcategoriaSelect.innerHTML = '';
    subcategoriaSelect.add(new Option('Selecione uma categoria', '', false, false));
    subcategoriaSelect.disabled = true;
    criaSubcategoriaBtn.disabled = true;
  }

  // abre modal de transacao
  document.querySelector('.bt-add-transacao')?.addEventListener('click', () => {
    modalCreateTransacao.style.display = 'block';
  });

  // controle de recorrencia (mantive seu código)
  lancamentoSelect.addEventListener('change', (e) => {
    if (e.target.value === 'recorrente') {
      recorrenciaPer.style.display = 'block';
      recorrenciaQtd.style.display = 'block';
    } else {
      recorrenciaPer.style.display = 'none';
      recorrenciaQtd.style.display = 'none';
    }
  });

  function resetForm() {
    if (formTransacao) {
      formTransacao.reset();
      // se toggleCamposRecorrencia é global, chama aqui
      if (typeof toggleCamposRecorrencia === 'function') toggleCamposRecorrencia();
    }
  }

  document.querySelectorAll('.fechar-modal').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetModal = document.querySelector(btn.dataset.target);
      if (targetModal) {
        targetModal.style.display = 'none';
        resetForm();
      }
    });
  });

  // Ouve evento disparado por modal_subcategoria.js quando uma subcategoria é criada
  document.addEventListener('subcategoria:created', function (e) {
    const detail = e.detail || {};
    const categoriaId = detail.categoria_id ?? detail.categoriaId;
    const novaSubcategoriaId = detail.id;

    // se a subcategoria pertence à categoria atualmente selecionada, repopula e seleciona
    if (String(categoriaSelect.value) === String(categoriaId)) {
      repopulaSubcategorias(categoriaId, novaSubcategoriaId);
    } else {
      // se a categoria atual for diferente, opcional: trocar a categoria para a da nova subcategoria
      // ou apenas ignorar. Aqui escolhemos repopular e selecionar a nova, e também definir a categoria.
      categoriaSelect.value = String(categoriaId);
      // dispara change para atualizar UI e repopular
      categoriaSelect.dispatchEvent(new Event('change', { bubbles: true }));
      // repopula e seleciona a nova subcategoria
      repopulaSubcategorias(categoriaId, novaSubcategoriaId);
    }
  });
});
