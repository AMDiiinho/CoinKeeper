import Swal from 'sweetalert2';

// CRIAR CARTÃO SUCESSO
document.addEventListener("DOMContentLoaded", () => {
    const alertaSucesso = document.querySelector('meta[name="alerta-sucesso"]');
    if (alertaSucesso) {
        Swal.fire({
            toast: true,
            position: 'bottom',
            icon: 'success',
            background: '#45D16A',
            color: '#fff',
            iconColor: '#fff',
            title: alertaSucesso.content,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    }
});

//ALERTA AO EXCLUIR CARTÃO
document.addEventListener("DOMContentLoaded", () => {
    // Seleciona todos os formulários de deletar
    document.querySelectorAll(".form-exclui-cartao").forEach(form => {
        form.querySelector(".icone-cartao-lixeira").addEventListener("click", function (e) {
            Swal.fire({
                icon: 'warning',
                customClass: {
                    icon: 'icone-alerta'
                },
                title: 'Excluir cartão?',
                text: "Essa ação não poderá ser desfeita!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#023997ff',
                confirmButtonText: 'Sim, excluir conta',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});