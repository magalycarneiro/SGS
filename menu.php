
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
<header class="topbar">
        <div class="container">
          <img src="img/logo3.png" alt="" class="logo">
          <nav class="menu">
          <a href="index.php">Home</a>
            <div class="dropdown">
            
            
              <button class="dropbtn">Funcionalidades</button>
              <div class="dropdown-content">
                <div class="dropdown-column">
                  <a href="agenda.php">Agenda Médica</a>
                  <a href="listaespera.php">Lista de espera</a>
                  <a href="gestaofinanceira.php">Gestão financeira</a>
                </div>
                <div class="dropdown-column">
                  <a href="agendamento.php">Agendamento do paciente</a>
                  <a href="prenatal.php">Pré-natal</a>
                  <a href="prontuario.php">Prontuário eletrônico</a>
                </div>
              </div>
            </div>
            
            <a href="planos.php">Preços</a>
            <a href="contato.php">Contato</a>
           
          </nav>
          <div class="actions">
            <a href="login.php"><button class="btn-outline">Login</button></a>
            <button class="btn-primary">Solicite um orçamento</button>
          </div>
        </div>
      </header>
      
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
          <!-- Adicione outras especialidades -->
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

<script>
  // Abrir modal
  document.querySelector('.btn-primary').addEventListener('click', function() {
    document.getElementById('orcamentoModal').style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Desabilita scroll da página
  });

  // Fechar modal
  document.querySelector('.close-modal').addEventListener('click', function() {
    document.getElementById('orcamentoModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Reabilita scroll
  });

  // Fechar ao clicar fora
  document.getElementById('orcamentoModal').addEventListener('click', function(e) {
    if(e.target === this) {
      this.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  });
</script>

</body>
</html>