document.querySelectorAll('.secao > .bt-menu-lateral').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault(); // evita navegação
        link.parentElement.classList.toggle('ativa');
    });
});
