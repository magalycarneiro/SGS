<!DOCTYPE html>
<?php
include "menu.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos</title>
    <link rel="stylesheet" href="css/planos.css">
</head>
<body>
<section class="plans-section">
    <div class="container">
        <div class="plans-header">
            <span class="subtitle">NOSSOS PLANOS</span>
            <h1>Encontre o plano ideal para a sua clínica</h1>
            <p class="lead-text">Tenha total controle da sua agenda, prontuário médico e
                 jornada do paciente, além da performance financeira e de marketing da sua 
                 clínica ou consultório.</p>
</div>
            <div class="plans-grid">
    <!-- Plano Essencial -->
    <div class="plan-card">
        <h3 class="plan-title">5 MESES</h3>
        <p class="plan-description">Ideal para período de testes de médicos em ínicio de carreira que 
            precisam de um sistema simples, acessível e eficiente para gerenciar seu consultório.</p>
        <ul class="plan-features">
        '<li>Agenda médica</li>
            <li>Lista de espera</li>
            <li>Pré agendamento do paciente</li>
            <li>Pré Natal</li>
            <li>Prontuário eletrônico</li>
        </ul>
        <button class="btn-plan">Ver preços</button>
    </div>

    <!-- Plano Financeiro -->
    <div class="plan-card">
        <h3 class="plan-title">1 ANO</h3>
        <p class="plan-description">Ideal para consultórios a muito tempo no 
            mercado procurando novos softwares para gerir sua clínica.</p>
        <ul class="plan-features">
            <li>Agenda médica</li>
            <li>Lista de espera</li>
            <li>Pré agendamento do paciente</li>
            <li>Pré Natal</li>
            <li>Prontuário eletrônico</li>
        </ul>
        <button class="btn-plan">Ver preços</button>
    </div>

    <!-- Plano Fidelização -->
    <div class="plan-card">
        <h3 class="plan-title">VITALÍCIO</h3>
        <p class="plan-description">Para clínicas fidelizadas com o programa que buscam gestão financeira e entendem
             a importância de uma gestão organizada.
        </p>
        <ul class="plan-features">
        <li>Agenda médica</li>
            <li>Lista de espera</li>
            <li>Pré agendamento do paciente</li>
            <li>Pré Natal</li>
            <li>Prontuário eletrônico</li>
            <li>Gestão financeira</li>
        </ul>
        <button class="btn-plan">Ver preços</button>
    </div>
</div>
        </div>
    </div>
</section>

<section class="faq-section">
    <h2>Perguntas Frequentes</h2>
    
    <div class="faq-container">
        <!-- Item 1 -->
        <div class="faq-item">
            <div class="faq-question">1. Como é a segurança de dados do sistema?</div>
            <div class="faq-answer">
                <p>Aqui na **************, tomamos todas as medidas de prevenção. 
                    Nosso site utiliza HTTPS, o que significa que o ambiente é seguro. 
                    Todos os dados são criptografados (gravados em forma de código) e utilizamos os servidores da 
                    AWS (Amazon Web Services), referência mundial em segurança de dados.</p>
            </div>
        </div>
        
        <!-- Item 2 -->
        <div class="faq-item">
            <div class="faq-question">2. Como funciona o processo de instalação?</div>
            <div class="faq-answer">
                <p>A *************** é um software em nuvem, ou seja, não fica precisa ser instalado ou armazenado 
                    em seu computador, não ocupando espaço de seu aparelho. Após a realização da assinatura, seu acesso e treinamentos na plataforma são liberados de forma imediata e já você já pode iniciar o uso do sistema.

</p>
            </div>
        </div>
        
        <!-- Item 3 -->
        <div class="faq-item">
            <div class="faq-question">3. Já tenho software, posso fazer a importação dos dados?</div>
            <div class="faq-answer">
                <p>Sim, oferecemos serviço de migração de dados sem 
                    custo adicional para planos anuais. Nossa equipe técnica cuida de toda a
                     transferência dos seus dados do sistema antigo para o GestãoDS, garantindo a integridade das informações.</p>
            </div>
        </div>
        
        <!-- Item 4 -->
        <div class="faq-item">
            <div class="faq-question">4. Qual o tempo de implementação do sistema?</div>
            <div class="faq-answer">
                <p>O sistema pode ser implementado em <span class="highlight">apenas 24 horas</span> para casos simples. Para migrações complexas ou clínicas com grande volume de dados, nosso tempo médio é de 3 a 5 dias úteis.</p>
            </div>
        </div>
        
        <!-- Item 5 -->
        <div class="faq-item">
            <div class="faq-question">5. Oferecem treinamento para a equipe?</div>
            <div class="faq-answer">
                <p>Sim, incluímos treinamentos online ilimitados para sua equipe, além de manuais operacionais e vídeos tutoriais. Para planos empresariais, oferecemos também treinamento presencial.</p>
            </div>
        </div>
        
        <!-- Item 6 -->
        <div class="faq-item">
            <div class="faq-question">6. Posso testar antes de contratar?</div>
            <div class="faq-answer">
                <p>Claro! Oferecemos <span class="highlight">15 dias grátis</span> para teste do sistema completo, sem necessidade de cartão de crédito. Basta cadastrar-se em nosso site para iniciar o período de avaliação.</p>
            </div>
        </div>
    </div>

<h3 class="planos-contato">Caso sua dúvida não tenha sido respondida entre em contato conosco pela página <a href="contato.php">Contato</a></h3>

</section>

<script>
    // Script para abrir/fechar as perguntas
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const item = question.parentNode;
            item.classList.toggle('active');
        });
    });
</script>
</body>
</html>