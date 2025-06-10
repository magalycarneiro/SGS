 // Script para seleção do tipo de usuário
        document.querySelectorAll('.user-type').forEach(type => {
            type.addEventListener('click', function() {
                document.querySelectorAll('.user-type').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const userType = this.dataset.type;
                document.getElementById('user_type').value = userType;
                
                // Altera o label do usuário conforme o tipo
                const userLabel = document.getElementById('user-label');
                if (userType === 'paciente') {
                    userLabel.textContent = 'Usuário';
                } else if (userType === 'medico') {
                    userLabel.textContent = 'Usuário (CRM)';
                } else if (userType === 'secretaria') {
                    userLabel.textContent = 'Usuário (ID)';
                }
            });
        });