<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cad_clinica.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="cad_clinica">
        <h3 class="h3">Cadastro de Clínica</h3>
    <form action="" method="post" class="form-agendamento">
        Nome da Clínica:
        <br>
         <input type="text" name="nome_clinica" id="nome_clinica" size="50" class="rounded-input">
        <br>
        <br>

        Endereço:
        <br>
        <input type="text" name="endereco" id="endereco" size="50" class="rounded-input" >
        <br>
        <br>

        CNPJ:
        <br>
        <input type="text" name="cnpj" id="cnpj" size="50" class="rounded-input">
        <br>
        <br>
        
        Telefone fixo:
        <br>
        <input type="tel" name="telefone" id="telefone" size="50" class="rounded-input" >
        <br>
        <br>

        <button class="button is-primary">Cadastrar</button>
    </form>

</body>
</html>