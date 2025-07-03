<?php
require_once('../Classes/Atendimento.class.php');
$atendimentos = Atendimento::listarTodos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Atendimentos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Seus Atendimentos</h1>

    <?php if (isset($_GET['sucesso'])): ?>
        <p style="color:green;">✅ Atendimento cadastrado com sucesso!</p>
    <?php endif; ?>

    <ul>
        <?php foreach($atendimentos as $at): ?>
            <li><?= $at->getInfo(); ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="novo_atendimento.php">+ Novo Atendimento</a><br>
    <a href="../index.php">Voltar ao painel</a>
</body>
</html>
