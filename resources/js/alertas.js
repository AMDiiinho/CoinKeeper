import Swal from 'sweetalert2';

// CRIAR CONTA SUCESSO
document.addEventListener("DOMContentLoaded", () => {
    const alertaSucesso = document.querySelector('meta[name="alerta-sucesso"]');
    if (alertaSucesso) {
        Swal.fire({
            toast: true,
            position: 'bottom',
            icon: 'success',
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

//ALERTA AO EXCLUIR CONTA
document.addEventListener("DOMContentLoaded", () => {
    // Seleciona todos os formulários de deletar
    document.querySelectorAll(".form-exclui-conta").forEach(form => {
        form.querySelector(".icone-conta-lixeira").addEventListener("click", function (e) {
            Swal.fire({
                icon: 'warning',
                customClass: {
                    icon: 'icone-alerta'
                },
                title: 'Excluir conta?',
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