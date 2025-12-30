// modal_categoria.js
// Gerencia a abertura/fechamento do modal de categoria, cria categoria via AJAX
// e repopula o select de categorias do formulário de transação selecionando a nova.

document.addEventListener('DOMContentLoaded', function () {
  
  const criaCategoriaBtn = document.getElementById('criaCategoria');
  const cancelCategoriaBtn = document.getElementById('cancelCategoria');
  const formTransacao = document.getElementById('formTransacao');
  const formCategoria = document.getElementById('formCategoria');
  const categoriaSelect = document.getElementById('categoria');
  const modalTitle = document.getElementById('modalTitle');
  const originalTitle = modalTitle ? modalTitle.textContent : '';

  // Proteção: se elementos essenciais não existirem, aborta e loga
  if (!formTransacao || !formCategoria) {
    console.warn('formTransacao ou formCategoria não encontrados no DOM. O script de modal_categoria foi abortado.');
    return;
  }

  // Abre o formulário de criação de categoria
  if (criaCategoriaBtn) {
    criaCategoriaBtn.addEventListener('click', function (e) {
      e.preventDefault();
      formTransacao.style.display = 'none';
      formCategoria.style.display = 'block';
      if (modalTitle) modalTitle.textContent = 'Nova Categoria';
    });
  }

  // Cancela a criação de categoria: limpa e volta ao form de transação
  if (cancelCategoriaBtn) {
    cancelCategoriaBtn.addEventListener('click', function (e) {
      e.preventDefault();
      formCategoria.reset();
      formCategoria.style.display = 'none';
      formTransacao.style.display = 'block';
      if (modalTitle) modalTitle.textContent = originalTitle;
    });
  }

  /**
   * Recarrega a lista de categorias do backend e repopula o <select>.
   * @param {string|number|null} idCategoriaSelecionada - id que deve ficar selecionado após repopular
   */
  async function atualizaSelect(idCategoriaSelecionada = null) {
    if (!categoriaSelect) {
      console.warn('categoriaSelect não encontrado. Não é possível repopular o select.');
      return;
    }

    // Desabilita o select enquanto carrega para evitar interações do usuário
    categoriaSelect.disabled = true;

    try {
      const resp = await fetch('/categorias/listar', {
        headers: {
          'Accept': 'application/json'
        },
      });

      if (!resp.ok) {
        console.error('Falha ao buscar categorias. status:', resp.status);
        return;
      }

      const categorias = await resp.json();

      // Limpa opções atuais
      categoriaSelect.innerHTML = '';

      // Adiciona placeholder (se desejar manter)
      const placeholder = new Option('Selecione...', '', false, false);
      categoriaSelect.add(placeholder);

      // Popula com as categorias retornadas
      categorias.forEach(cat => {
        // garante que value seja string para evitar mismatch
        const opt = new Option(cat.nome, String(cat.id), false, false);
        categoriaSelect.add(opt);
      });

      // Se foi passada uma categoria para selecionar, tenta selecioná-la
      if (idCategoriaSelecionada !== null && idCategoriaSelecionada !== undefined) {
        // converte para string para garantir match
        categoriaSelect.value = String(idCategoriaSelecionada);
        // se o value não existir, mantém o placeholder
        if (categoriaSelect.value !== String(idCategoriaSelecionada)) {
          console.warn('idCategoriaSelecionada não encontrado na lista repopulada:', idCategoriaSelecionada);
        }
      }

      // Dispara evento change para que outros scripts reajam à atualização
      categoriaSelect.dispatchEvent(new Event('change', { bubbles: true }));
    } catch (err) {
      console.error('Erro ao atualizar select de categorias:', err);
    } finally {
      // Reabilita o select mesmo em caso de erro
      categoriaSelect.disabled = false;
    }
  }

  // Listener do submit do formCategoria: cria categoria via AJAX e atualiza o select
  formCategoria.addEventListener('submit', async function (e) {
    e.preventDefault();

    const url = formCategoria.getAttribute('action');
    const formData = new FormData(formCategoria);
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    try {
      // Envia POST para criar a categoria
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': token,
          'Accept': 'application/json'
        },
        body: formData,
        credentials: 'same-origin'
      });

      // tenta ler JSON de resposta (pode falhar se backend retornar HTML)
      const data = await res.json().catch(() => null);

      if (!res.ok || !data) {
        // trata erros de validação ou resposta inesperada
        const message = data?.message || 'Erro ao criar categoria';
        alert(message);
        console.log('Erros retornados:', data?.errors || data);
        return;
      }

      // Se chegou aqui, a categoria foi criada com sucesso.
      // Atualiza o select com a lista mais recente e seleciona a nova categoria.
      await atualizaSelect(data.id);

      // Restaura a UI do modal para o formulário de transação
      formCategoria.reset();
      formCategoria.style.display = 'none';
      formTransacao.style.display = 'block';
      if (modalTitle) modalTitle.textContent = originalTitle;

    } catch (error) {
      console.error('Erro de rede ao criar categoria:', error);
      alert('Erro de rede ao criar categoria');
    }
  });

  atualizaSelect();
});

