// secretaria.js - Funcionalidades da área da secretária

document.addEventListener('DOMContentLoaded', function() {
    // Controle das abas
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove classe active de todas as abas e conteúdos
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Adiciona classe active à aba clicada
            this.classList.add('active');
            
            // Mostra o conteúdo correspondente
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Controle do formulário de agendamento
    const novoAgendamentoBtn = document.getElementById('novoAgendamento');
    const cancelarAgendamentoBtn = document.getElementById('cancelarAgendamento');
    const agendamentoFormContainer = document.getElementById('agendamentoFormContainer');
    
    if (novoAgendamentoBtn) {
        novoAgendamentoBtn.addEventListener('click', function() {
            agendamentoFormContainer.style.display = 'block';
            agendamentoFormContainer.scrollIntoView({ behavior: 'smooth' });
            
            // Define a data atual como padrão
            document.getElementById('data').valueAsDate = new Date();
        });
    }
    
    if (cancelarAgendamentoBtn) {
        cancelarAgendamentoBtn.addEventListener('click', function() {
            agendamentoFormContainer.style.display = 'none';
        });
    }
    
    // Controle do formulário de lista de espera
    const novoListaEsperaBtn = document.getElementById('novoListaEspera');
    const cancelarListaEsperaBtn = document.getElementById('cancelarListaEspera');
    const listaEsperaFormContainer = document.getElementById('listaEsperaFormContainer');
    
    if (novoListaEsperaBtn) {
        novoListaEsperaBtn.addEventListener('click', function() {
            listaEsperaFormContainer.style.display = 'block';
            listaEsperaFormContainer.scrollIntoView({ behavior: 'smooth' });
        });
    }
    
    if (cancelarListaEsperaBtn) {
        cancelarListaEsperaBtn.addEventListener('click', function() {
            listaEsperaFormContainer.style.display = 'none';
        });
    }
    
    // Controle do formulário de lançamento financeiro
    const novoLancamentoBtn = document.getElementById('novoLancamento');
    const cancelarLancamentoBtn = document.getElementById('cancelarLancamento');
    const lancamentoFormContainer = document.getElementById('lancamentoFormContainer');
    
    if (novoLancamentoBtn) {
        novoLancamentoBtn.addEventListener('click', function() {
            lancamentoFormContainer.style.display = 'block';
            lancamentoFormContainer.scrollIntoView({ behavior: 'smooth' });
            
            // Define a data atual como padrão
            document.getElementById('f_data').valueAsDate = new Date();
        });
    }
    
    if (cancelarLancamentoBtn) {
        cancelarLancamentoBtn.addEventListener('click', function() {
            lancamentoFormContainer.style.display = 'none';
        });
    }
    
    // Botões de agendamento a partir da lista de espera
    const agendarButtons = document.querySelectorAll('.btn-agendar');
    agendarButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cpf = this.getAttribute('data-cpf');
            
            // Aqui você pode preencher automaticamente o formulário de agendamento
            // com os dados do paciente da lista de espera
            alert('Implementar preenchimento automático do agendamento para CPF: ' + cpf);
            
            // Mudar para a aba de agendamento
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            document.querySelector('.tab[data-tab="agenda"]').classList.add('active');
            document.getElementById('agenda').classList.add('active');
            
            // Mostrar formulário de agendamento
            agendamentoFormContainer.style.display = 'block';
            agendamentoFormContainer.scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // Botões de edição (simulação)
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            alert('Funcionalidade de edição será implementada aqui\nID: ' + id);
        });
    });
});