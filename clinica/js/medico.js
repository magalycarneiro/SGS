// medico.js - Funcionalidades da área do médico

document.addEventListener('DOMContentLoaded', function() {
    // Controle do formulário de prontuário
    const novoProntuarioBtn = document.getElementById('novoProntuario');
    const cancelarProntuarioBtn = document.getElementById('cancelarProntuario');
    const prontuarioFormContainer = document.getElementById('prontuarioFormContainer');
    const prontuarioForm = document.getElementById('prontuarioForm');
    
    if (novoProntuarioBtn) {
        novoProntuarioBtn.addEventListener('click', function() {
            // Limpa o formulário
            prontuarioForm.reset();
            document.getElementById('id_prontuario').value = '';
            
            // Define a data atual como padrão
            document.getElementById('data_consulta').valueAsDate = new Date();
            
            // Mostra o formulário
            prontuarioFormContainer.style.display = 'block';
            
            // Rola até o formulário
            prontuarioFormContainer.scrollIntoView({ behavior: 'smooth' });
        });
    }
    
    if (cancelarProntuarioBtn) {
        cancelarProntuarioBtn.addEventListener('click', function() {
            prontuarioFormContainer.style.display = 'none';
        });
    }
    
    // Editar prontuário existente
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const prontuarioId = this.getAttribute('data-id');
            
            // Aqui você faria uma requisição AJAX para buscar os dados do prontuário
            // Estou simulando com um alert para simplificar
            alert('Funcionalidade de edição será implementada aqui\nProntuário ID: ' + prontuarioId);
            
            // Na implementação real, você preencheria o formulário com os dados
            // e mostraria o formulário para edição
        });
    });
    
    // Validação do formulário de prontuário
    if (prontuarioForm) {
        prontuarioForm.addEventListener('submit', function(e) {
            // Validações podem ser adicionadas aqui
            console.log('Formulário de prontuário enviado');
            // O envio real será tratado pelo processa_prontuario.php
        });
    }
});