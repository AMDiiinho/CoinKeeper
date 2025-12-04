document.addEventListener('DOMContentLoaded', function() {

    function toggleCamposCredito(tipo) {
        const divLimite = document.querySelector('#limiteCartao');
        if (tipo === 'credito') {
            divLimite.style.display = 'block';
        } else {
            divLimite.style.display = 'none';
        }
    }

    // Botão de criação
    const btAdd = document.querySelector('.bt-add-cartao');
    if (btAdd) {
        btAdd.addEventListener('click', function() {
            const modal = document.querySelector('#modalContainer');
            const form = document.querySelector('#formCartao');

            document.querySelector('#modalTitulo').innerText = 'Novo Cartão';
            form.action = '/carteira';
            document.querySelector('#formMethod').value = 'POST';

            form.reset();
            toggleCamposCredito(''); // esconde campos de crédito

            const campoSaldo = document.querySelector('#campoSaldo');
            campoSaldo.value = '';
            campoSaldo.disabled = false;

            modal.style.display = 'block';
        });
    }

    // Botão de edição
    document.querySelectorAll('.icone-cartao-caneta').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nome = this.dataset.nome;
            const banco = this.dataset.banco;
            const tipo = this.dataset.tipo;
            const limite = this.dataset.limite;
            const fechamento = this.dataset.fechamento;
            const vencimento = this.dataset.vencimento;
            const saldo = this.dataset.saldo;

            const modal = document.querySelector('#modalContainer');
            const form = document.querySelector('#formCartao');

            document.querySelector('#modalTitulo').innerText = 'Editar Cartão';
            form.action = '/carteira/' + id;
            document.querySelector('#formMethod').value = 'PATCH';

            document.querySelector('#campoNome').value = nome;
            document.querySelector('#campoBanco').value = banco;
            document.querySelector('#tipoCartao').value = tipo;
            document.querySelector('#campoLimite').value = limite;
            document.querySelector('#campoFechamento').value = fechamento;
            document.querySelector('#campoVencimento').value = vencimento;

            toggleCamposCredito(tipo); // mostra/esconde conforme tipo

            const campoSaldo = document.querySelector('#campoSaldo');
            campoSaldo.value = saldo;
            campoSaldo.disabled = true;

            modal.style.display = 'block';
        });
    });

    // Atualiza dinamicamente se o usuário trocar o tipo no select
    const tipoSelect = document.querySelector('#tipoCartao');
    if (tipoSelect) {
        tipoSelect.addEventListener('change', function() {
            toggleCamposCredito(this.value);

            if (this.value === 'debito' || 'pre-pago') {
            // limpa os campos de crédito
            document.querySelector('#campoLimite').value = '';
            document.querySelector('#campoFechamento').value = '';
            document.querySelector('#campoVencimento').value = '';
        }
        });
    }

    // Botão fechar
    const fechar = document.querySelector('#fechar');
    if (fechar) {
        fechar.addEventListener('click', function() {
            document.querySelector('#modalContainer').style.display = 'none';
        });
    }
});

