<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/agendamento.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  </head>
    <?php include 'menu.php'; ?>
</head>
<body>
    <div class="agendamento">
        <h3 class="h3">Agendamento de consultas</h3>
    <form action="principal.php" method="post" class="form-agendamento">
        Nome completo:
        <br>
         <input type="text" name="nome" id="nome" size="50" class="rounded-input">
        <br>
        <br>

        Data de nascimento: 
        <br>
        <input type="date" name="data" id="data" size="50" class="rounded-input">
        <br>
        <br>

        CPF/RG:
        <br>
        <input type="text" name="cpf" id="cpf" size="50" class="rounded-input">
        <br>
        <br>

        Médico:
        <br>
        <select name="medico" id="medico" widht="20px" class="rounded-input">
            <option value="0">Selecione um médico</option>
            <option value="1">Dra. Maria da Silva</option>
            <option value="2">Dr. João da Silva</option>
            <option value="3">Dra. Maria da Silva</option>
        </select>
        <br>
        <br>

        Data e hora da consulta:
        <br>
        <input type="datetime-local" name="datahora" id="datahora" size="50" class="rounded-input" >
        <br>
        <br>

        <button class="button is-primary">Agendar</button>
    </form>
    </div>

    <div class="img-ag">
     <img src="img/agendamento.png" alt="">
       
    </div>

    <div class="next">
        <a href="principal.php"><img src="img/next.png" alt="" style="width: 40px; height: 40px;"></a>
    </div>
</body>
</html>