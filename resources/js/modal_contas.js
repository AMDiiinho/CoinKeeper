const abrirModal = document.getElementById('abreModal');
const modal = document.getElementById('modalContainer');
const fecharModal = document.getElementById('fechar');

abreModal.addEventListener('click', () => {
    modal.style.display = "block";
});

fecharModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if(event.target === modal) {
        modal.style.display = 'none';
    }
});