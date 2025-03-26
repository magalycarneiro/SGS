<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cad_medico.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="cad_medico">
        <h3 class="h3">Cadastro de Médico</h3>
    <form action="" method="post" class="form-agendamento">
        Nome completo:
        <br>
         <input type="text" name="nome" id="nome" size="50" class="rounded-input">
        <br>
        <br>

        CPF/RG:
        <br>
        <input type="text" name="cpf" id="cpf" size="50" class="rounded-input">
        <br>
        <br>

        
        Telefone:
        <br>
        <input type="tel" name="telefone" id="telefone" size="50" class="rounded-input" >
        <br>
        <br>

        Tipo de registro:
        <br>
        <select name="tipo_registro" id="tipo_registro" widht="20px" class="rounded-input">
            <option value="0">Selecione um tipo de registro</option>
            <option value="1">CRO</option>
            <option value="2">CRM</option>
            <option value="3">CRF</option>
            <option value="4">CREFITO</option>
        </select>
        <br>
        <br>

        Número do registro:
        <br>
        <input type="number" name="numero_registro" id="numero_registro" size="50" class="rounded-input" >
        <br>
        <br>

        <button class="button is-primary">Cadastrar</button>
    </form>

</body>
</html>