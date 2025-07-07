<?php
require_once('../Classes/Atendimento.class.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = $_POST['data'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    Atendimento::salvar($data, $tipo, $descricao);
    header("Location: index.php?sucesso=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Novo Atendimento</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Novo Atendimento</h1>
    <form method="POST">
        <label>Data:</label><br>
        <input type="date" name="data" required><br><br>

        <label>Tipo:</label><br>
        <select name="tipo" required>
            <option value="Presencial">Presencial</option>
            <option value="Telefone">Telefone</option>
        </select><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Salvar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
