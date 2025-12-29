document.addEventListener('DOMContentLoaded', () => {

    const modalCreateTransacao = document.getElementById('modalCreateTransacao');
    const lancamentoSelect = document.querySelector('[name="lancamento"]');
    const recorrenciaContainer = document.getElementById('recorrenciaContainer');
    const formTransacao = document.getElementById('formTransacao');
    const recorrenciaPeriodo = document.getElementsByName('recorrencia_periodo');
    const recorrenciaQtd = document.getElementsByName('recorrencia_qtd');


    /*

        ------FUNÇÃO PARA CONTROLAR A EXIBIÇÃO DOS CAMPOS RELACIONADOS A RECORRENCIA DA TRANSACAO--------

    */


    lancamentoSelect.addEventListener('change', (e) => {
        if (e.target.value === 'recorrente') {
            recorrenciaContainer.style.display = 'block';
        } else {
            recorrenciaContainer.style.display = 'none';
            console.log(recorrenciaPeriodo.value);
        }
    });

    /*

        ------FUNÇÃO PARA APAGAR TODOS OS VALORES DO FORM AO FECHÁ-LO--------

    */

    function resetForm() {
        if (formTransacao){
            formTransacao.reset();

            toggleCamposRecorrencia();
        }
    }


    //Detecta o clique e altera o display do modal de none para block, exibindo o form
    document.querySelector('.bt-add-transacao')?.addEventListener('click', () => {
        modalCreateTransacao.style.display = 'block';


    })

    //detecta o clique no botão fechar-modal e fecha o form, alterando o display dele de block pra none
    document.querySelectorAll('.fechar-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetModal = document.querySelector(btn.dataset.target);

            if (targetModal) {
                targetModal.style.display = 'none';

                resetForm();
            }
        });
    });
});