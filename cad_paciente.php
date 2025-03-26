<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cad_paciente.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="cad_paciente">
        <h3 class="h3">Cadastro de Paciente</h3>
    <form action="" method="post" class="form-agendamento">
        Nome do Paciente:
        <br>
         <input type="text" name="nome_paciente" id="nome_paciente" size="50" class="rounded-input">
        <br>
        <br>

        E-mail:
        <br>
        <input type="text" name="email_paciente" id="email_paciente" size="50" class="rounded-input" >
        <br>
        <br>

        Crie uma senha:
        <br>
        <input type="password" name="senha" id="senha" size="50" class="rounded-input" >
        <br>
        <br>

        Confirme a senha:
        <br>
        <input type="password" name="confirmacao_senha" id="confirmacao_senha" size="50" class="rounded-input" >
        <br>
        <br>

        CPF:
        <br>
        <input type="text" name="cpf" id="cpf" size="50" class="rounded-input">
        <br>
        <br>
        
        Telefone:
        <br>
        <input type="tel" name="telefone" id="telefone" size="50" class="rounded-input" >
        <br>
        <br>

        Endereço:
        <br>
        <input type="text" name="endereco" id="endereco" size="50" class="rounded-input" >
        <br>
        <br>

        <button class="button is-primary">Cadastrar</button>
    </form>

</body>
</html>