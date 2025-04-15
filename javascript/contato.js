document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-contato');
    const campos = formulario.querySelectorAll('input[type="text"], input[type="tel"], input[type="email"], textarea');

    formulario.addEventListener('submit', function(event) {
        let valido = true;

        campos.forEach(campo => {
            const idCampo = campo.getAttribute('id');
            const erroElement = document.getElementById(`erro-${idCampo}`);

            if (campo.hasAttribute('required') && campo.value.trim() === '') {
                erroElement.textContent = 'Este campo é obrigatório.';
                valido = false;
            } else {
                erroElement.textContent = ''; // Limpa a mensagem de erro
            }

            // Validação específica para o campo de e-mail
            if (idCampo === 'email' && campo.value.trim() !== '') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(campo.value)) {
                    erroElement.textContent = 'Por favor, insira um e-mail válido.';
                    valido = false;
                }
            }

            // Validação específica para o campo de WhatsApp (formato aproximado)
            if (idCampo === 'whatsapp' && campo.value.trim() !== '') {
                const whatsappRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
                if (!whatsappRegex.test(campo.value)) {
                    erroElement.textContent = 'Por favor, insira um WhatsApp válido (Ex.: (XX) XXXXX-XXXX).';
                    valido = false;
                }
            }
        });

        if (!valido) {
            event.preventDefault(); // Impede o envio do formulário se houver erros
        } else {
            // Aqui você pode adicionar o código para enviar o formulário
            alert('Formulário enviado com sucesso!'); // Apenas para demonstração
        }
    });
});