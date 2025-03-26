<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Document</title>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="tipo-c">
    <h3>Selecione o tipo de cadastro</h3>
</div>

    <div class="medico">

<a href="cad_medico.php"><img src="img/medico.png" alt="" style="width: 300px; height: 300px;"></a>
        <h4 class="text-med">Médico</h4>
    </div>

    <div class="paciente">

<a href="cad_paciente.php"><img src="img/paciente.png" alt="" style="width: 300px; height: 450px;"></a>
<h4 class="text-med">Paciente</h4>
    </div>

    <div class="clinica">
    <h4 class="text-cli">Clínica</h4>
<a href="cad_clinica.php"><img src="img/clinica.png" alt="" style="width: 200px; height: 300px;"></a>

    </div>
</body>
</html>