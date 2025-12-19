document.addEventListener('DOMContentLoaded', () => {
    // --- Lógica Modal Criar ---
    const modalCreate = document.getElementById('modalCreate');
    const createBanco = document.getElementById('createBanco');
    const createTipo = document.getElementById('createTipo');
    const divTipoCreate = document.getElementById('divTipoCreate');
    const camposCreditoCreate = document.getElementById('camposCreditoCreate');
    

    // Botão abrir modal criar
    document.querySelector('.bt-add-cartao')?.addEventListener('click', () => {
        modalCreate.style.display = 'block';
    });

    // Lógica visual do Create (Carteira vs Banco)
    createBanco.addEventListener('change', (e) => {
        if (e.target.value === 'carteira') {
            divTipoCreate.style.display = 'none';
            camposCreditoCreate.style.display = 'none';
            createTipo.value = ''; 
        } else {
            divTipoCreate.style.display = 'block';
        }
    });

    createTipo.addEventListener('change', (e) => {
        if (e.target.value === 'credito') {
            camposCreditoCreate.style.display = 'block';
        } else {
            camposCreditoCreate.style.display = 'none';
        }
    });


    // --- Lógica Modal Editar ---
    const modalEdit = document.getElementById('modalEdit');
    const formEdit = document.getElementById('formEdit'); 
    const camposCreditoEdit = document.getElementById('camposCreditoEdit');

    document.querySelectorAll('.icone-cartao-caneta').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = btn.dataset;

        
            formEdit.action = `/carteira/${data.id}`; 
            
            // Preencher campos
            document.getElementById('editNome').value = data.nome;
            document.getElementById('editBancoVisual').value = data.banco;
            document.getElementById('editTipoVisual').value = data.tipo;
            document.getElementById('editSaldoVisual').value = data.saldo; 

            // Lógica de campos de crédito no Edit
            if (data.tipo === 'credito') {
                camposCreditoEdit.style.display = 'block'; 
                document.getElementById('editLimite').value = data.limite;
                document.getElementById('editFechamento').value = data.fechamento;
                document.getElementById('editVencimento').value = data.vencimento;
            } else {
                camposCreditoEdit.style.display = 'none';
            }

            modalEdit.style.display = 'block';
        });
    });


    // --- Lógica Global (Fechar Modais) ---
    document.querySelectorAll('.fechar-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector(btn.dataset.target).style.display = 'none';
        });
    });

    // Reabrir modal se houver erro de validação (Backend Flash)
    // O Laravel vai injetar um script se houver erro numa Bag específica
    
    
});
