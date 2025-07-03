<?php
require_once('../Classes/Exames.class.php');
$exames = Exame::listarTodos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exames</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Seus Exames</h1>
    <ul>
        <?php foreach($exames as $ex): ?>
            <li><?= $ex->getInfo(); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="../index.php">Voltar ao painel</a>
</body>
</html>
