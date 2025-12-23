document.addEventListener('DOMContentLoaded', () => {

    const modalCreateTransacao = document.getElementById('modalCreateTransacao');
    

    //Detecta o clique e altera o display do modal de none para block, exibindo o form
    document.querySelector('.bt-add-transacao')?.addEventListener('click', () => {
        modalCreateTransacao.style.display = 'block';
    })

    //detecta o clique no botão fechar-modal e fecha o form, alterando o display dele de block pra none
    document.querySelectorAll('.fechar-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector(btn.dataset.target).style.display = 'none';
        });
    });
});