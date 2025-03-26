document.addEventListener('DOMContentLoaded', (event) => {
    const agendamentoLink = document.getElementById('agendamento-link');
    const dropdownContent = document.getElementById('dropdown-content');

    agendamentoLink.addEventListener('click', (e) => {
        e.preventDefault();
        // Alternar a exibição do conteúdo dropdown
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Esconder o dropdown ao clicar fora dele
    window.addEventListener('click', (e) => {
        if (!agendamentoLink.contains(e.target) && !dropdownContent.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});
