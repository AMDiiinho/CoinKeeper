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
            
            // --- INÍCIO: CAMPOS VISUAIS E HIDDEN CORRIGIDOS ---
            
            // Campos de Leitura (Visual)
            document.getElementById('editBancoVisual').value = data.banco; 
            document.getElementById('editTipoVisual').value = data.tipo;
            document.getElementById('editSaldoVisual').value = data.saldo; 

            // Campos HIDDEN (Para enviar no PATCH)
            document.getElementById('editBancoHidden').value = data.banco; // NOVO: Campo Hidden Banco
            document.getElementById('editTipoHidden').value = data.tipo;   // NOVO: Campo Hidden Tipo
            document.getElementById('editSaldoHidden').value = data.saldo; // NOVO: Campo Hidden Saldo
            
            // --- FIM: CAMPOS VISUAIS E HIDDEN CORRIGIDOS ---

            // Lógica de campos de crédito no Edit
            if (data.tipo === 'credito') {
                camposCreditoEdit.style.display = 'block'; 
                document.getElementById('editLimite').value = data.limite;
                document.getElementById('editFechamento').value = data.fechamento;
                document.getElementById('editVencimento').value = data.vencimento;
            } else {
                camposCreditoEdit.style.display = 'none';
                
                // Limpar campos de crédito (boa prática ao fechar)
                document.getElementById('editLimite').value = '';
                document.getElementById('editFechamento').value = '';
                document.getElementById('editVencimento').value = '';
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
    const modalEditData = document.getElementById('modalEdit')?.dataset;
    if (modalEditData?.showError === 'true' && modalEditData.editId) {
        // Se houver erro de validação (edit bag)
        modalEdit.style.display = 'block';

        // ATENÇÃO: Se o modal reabrir devido a erro, o JS precisa saber qual ID está editando.
        // O Laravel salva o ID na sessão (`session('editar_cartao_id')`) e você usa no data-edit-id.
        // Você precisará de uma lógica extra aqui para popular os campos `old()`
        // se o erro vier do backend e não de um clique no botão.
        // Por hora, apenas reabre o modal.
        
        // Exemplo: forçar a action do form se o ID estiver na sessão
        formEdit.action = `/carteira/${modalEditData.editId}`;
        
        // O preenchimento com `old()` já está no Blade, o que resolve o problema.
    }
});