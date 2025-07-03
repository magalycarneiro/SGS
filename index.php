<!DOCTYPE html>
<?php
include "menu.php";
?>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SGS</title>
  <link rel="stylesheet" href="css/estiloindex.css">

</head>
<body>
   

  <section class="hero">
    <div class="container hero-content">
      <div class="hero-text">
        <span class="tag">Software médico</span>
        <h1>Escolhido por mais de 15 mil profissionais da saúde</h1>
        <p>Do prontuário eletrônico ao relacionamento com seu paciente, o Lýra Clinic é o software médico completo para você alcançar seus objetivos como médico.</p>
        <strong>Ficou curioso? Entre em contato conosco e descubra como podemos ajudar!</strong>
        <div class="hero-buttons">
          <button class="btn-primary" id="abrirModal">Solicite um orçamento</button>
          <!-- Modal de Orçamento -->
<div class="modal-overlay" id="orcamentoModal">
  <div class="modal-container">
    <button class="close-modal">&times;</button>
    
    <div class="modal-header">
      <h3>Preço</h3>
      <p>Quer ter mais controle sobre a gestão da sua clínica?</p>
      <p>Preencha as informações e agende uma demonstração:</p>
    </div>

    <form class="modal-form">
      <div class="form-row">
        <div class="form-group">
          <label>Nome*</label>
          <input type="text" required>
        </div>
        <div class="form-group">
          <label>Sobrenome*</label>
          <input type="text" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>WhatsApp*</label>
          <input type="tel" placeholder="(51) 99999-9000" required>
        </div>
      </div>

      <div class="form-group">
        <label>E-mail*</label>
        <input type="email" required>
      </div>

      <div class="form-group">
        <label>Especialidade*</label>
        <select required>
          <option value="">Selecione</option>
          <option>Clínico Geral</option>
          <option>Cardiologia</option>
          <option>Dermatologia</option>
          <option>Fisioterapia</option>
          <option>Odontologia</option>
          <option>Cirurgia plástica</option>
          <option>Pediatria</option>
          <option>Psiquiatria</option>
          <option>Dermatologia</option>
          <option>Oftalmologia</option>
          <option>Pediatria</option>
          <option>Dermatologia</option>
          <option>Outra área médica</option>          
          <option>Não trabalho em área médica</option>
          
        </select>
      </div>

      <div class="form-checkbox">
        <input type="checkbox" id="privacidade" required>
        <label for="privacidade">Estou de acordo em fornecer meus dados para contato de acordo com a Política de Privacidade.*</label>
      </div>

      <button type="submit" class="btn-submit">Quero mais informações</button>
    </form>
  </div>
</div>

          <a href="planos.php" class="link-btn">Conheça nossos planos</a>
        </div>
      </div>
      <div class="hero-video">
        <section class="carousel-section">
  <div class="carousel">
    <input type="radio" name="carousel" id="slide1" checked>
    <input type="radio" name="carousel" id="slide2">
    <input type="radio" name="carousel" id="slide3">

    <div class="slides">
      <div class="slide s1">
      <img src="img/"  alt="Imagem 1">
      </div>
      <div class="slide s2">
        <img src="img/" alt="Imagem 2">
      </div>
      <div class="slide s3">
        <img src="img3.jpg" alt="Imagem 3">
      </div>
    </div>

    <div class="navigation">
      <label for="slide1"></label>
      <label for="slide2"></label>
      <label for="slide3"></label>
    </div>
  </div>
</section>

            </div>
          </section>
          
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <span>🧑‍💻 Suporte feito por humanos</span>
      <span>☁️ Sistema 100% na nuvem</span>
      <span>✈️ Migramos seus dados</span>
    </div>
  </footer>

  <section class="hero-section">
  <div class="container">
    <span class="section-tag">Comece aqui</span>
    <h1 class="hero-title">Prontuário eletrônico e software de gestão para clínicas e consultórios médicos.</h1>
    <p class="hero-description">Nosso software foi construído para atender médicos em todas as fases
       da carreira, do início do consultório a clínicas com milhares de pacientes.</p>
  </div>
</section>



<div class="container-fim">
        <header>
            <h1>Essencial</h1>
            <p class="subtitle-fim">As ferramentas essenciais para o dia a dia do seu consultório</p>
        </header>
        
        <main>
            <p class="description-fim">O que você realmente precisa para controlar sua agenda e ter acesso rápido às informações dos seus pacientes, seja durante um atendimento ou pelo seu smartphone.</p>
        
            
            <div class="features-fim">
                <div class="feature-item-fim">Agendamento on-line</div>
                <div class="feature-item-fim">Prontuário eletrônico</div>
                <div class="feature-item-fim">Pré-cadastro de pacientes</div>
                <div class="feature-item-fim">Telemedicina</div>
                <div class="feature-item-fim">Assinatura digital</div>
                <div class="feature-item-fim">Confirmação via WhatsApp</div>
            </div>
        </main>
    </div>

    <script>
  document.addEventListener('DOMContentLoaded', function () {
  const abrirModal = document.getElementById('abrirModal');
  const modal = document.getElementById('orcamentoModal');
  const fecharModal = document.querySelector('.close-modal');

  if (abrirModal && modal && fecharModal) {
    abrirModal.addEventListener('click', function () {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    });

    fecharModal.addEventListener('click', function () {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });
  }
});

</script>

</body>
</html>
