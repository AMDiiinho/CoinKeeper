document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#modalContainer');
    const form = document.querySelector('#formCartao');
    const formMethod = document.querySelector('#formMethod');
    const titulo = document.querySelector('#modalTitulo');

    const campoNome = document.querySelector('#campoNome');
    const campoBanco = document.querySelector('#campoBanco');
    const tipoSelect = document.querySelector('#tipoCartao');
    const campoLimite = document.querySelector('#campoLimite');
    const campoFechamento = document.querySelector('#campoFechamento');
    const campoVencimento = document.querySelector('#campoVencimento');
    const campoSaldo = document.querySelector('#campoSaldo');

    const isEditMode = () => formMethod.value === 'PATCH';

    function applyCreateState() {
        const banco = campoBanco.value, tipo = tipoSelect.value;
        campoSaldo.readOnly = false;

        // Banco e Tipo devem estar habilitados na criação
        campoBanco.disabled = false;
        tipoSelect.disabled = false;

        if (banco === 'carteira') {
            tipoSelect.disabled = true;
            tipoSelect.value = ''; // força vazio
            [campoLimite, campoFechamento, campoVencimento].forEach(c => {
                c.value = '';
                c.disabled = true;
            });
        } else {
            if (tipo === 'credito') {
                [campoLimite, campoFechamento, campoVencimento].forEach(c => c.disabled = false);
            } else {
                [campoLimite, campoFechamento, campoVencimento].forEach(c => {
                    c.value = '';
                    c.disabled = true;
                });
            }
        }
    }


    function applyEditState() {
        // Nome pode ser alterado
        campoNome.readOnly = false;

        // Banco e Tipo bloqueados
        campoBanco.disabled = true;
        tipoSelect.disabled = true;

        // Saldo bloqueado
        campoSaldo.readOnly = true;

        // Campos de crédito
        if (tipoSelect.value === 'credito') {
            [campoLimite, campoFechamento, campoVencimento].forEach(c => {
                c.readOnly = false;   // editáveis
                c.disabled = false;   // garantir que não fiquem desabilitados
            });
        } else {
            [campoLimite, campoFechamento, campoVencimento].forEach(c => {
                c.value = '';
                c.readOnly = true;    // bloqueados
                c.disabled = false;   // não usar disabled, só readOnly
            });
        }
    }




    // Botão de criação
    document.querySelector('.bt-add-cartao')?.addEventListener('click', () => {
        titulo.innerText = 'Novo Cartão';
        form.action = '/carteira';
        formMethod.value = 'POST';
        form.reset();
        applyCreateState();
        modal.style.display = 'block';
    });

    // Botão de edição
    document.querySelectorAll('.icone-cartao-caneta').forEach(btn => {
        btn.addEventListener('click', () => {
            titulo.innerText = 'Editar Cartão';
            form.action = '/carteira/' + btn.dataset.id;
            formMethod.value = 'PATCH';

            campoNome.value = btn.dataset.nome;
            campoBanco.value = btn.dataset.banco;
            tipoSelect.value = btn.dataset.tipo;
            campoLimite.value = btn.dataset.limite;
            campoFechamento.value = btn.dataset.fechamento;
            campoVencimento.value = btn.dataset.vencimento;
            campoSaldo.value = btn.dataset.saldo;

            applyEditState();
            modal.style.display = 'block';
        });
    });

    // Dinâmica de selects
    campoBanco.addEventListener('change', () => isEditMode() ? applyEditState() : applyCreateState());
    tipoSelect.addEventListener('change', () => isEditMode() ? applyEditState() : applyCreateState());

    // Fechar modal
    document.querySelector('#fechar')?.addEventListener('click', () => {
        modal.style.display = 'none';
        document.querySelectorAll('.erro').forEach(el => el.remove());
    });


    // Reabrir modal com erros
    const metaEditar = document.querySelector('meta[name="editar-cartao-id"]');
    if (metaEditar) {
        document.querySelector(`.icone-cartao-caneta[data-id="${metaEditar.content}"]`)?.click();
    }

});
