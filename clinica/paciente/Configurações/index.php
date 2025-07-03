<?php
require_once('../Classes/Configuracao.class.php');
$conf = new Configuracao();
$preferencias = $conf->getPreferencias();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Configurações</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Preferências do Sistema</h1>
    <form method="post">
        <label>Notificações:
            <input type="checkbox" name="notificacoes" <?= $preferencias['notificacoes'] ? 'checked' : '' ?>>
        </label><br><br>
        <label>Tema:
            <select name="tema">
                <option <?= $preferencias['tema'] === 'Claro' ? 'selected' : '' ?>>Claro</option>
                <option <?= $preferencias['tema'] === 'Escuro' ? 'selected' : '' ?>>Escuro</option>
            </select>
        </label><br><br>
        <button type="submit">Salvar</button>
    </form>
    <a href="../index.php">Voltar ao painel</a>
</body>
</html>
