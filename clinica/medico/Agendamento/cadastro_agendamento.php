<?php
// Variável para controlar a exibição da mensagem
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Você pode capturar os dados aqui, mas não salvar (já que pediu sem banco)
    $mensagem = "Agendamento cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Agendamento</title>
<style>
    body { background:#f7f4fb; font-family:Arial; display:flex; justify-content:center; }
    .container { background:#fff; width:60%; margin-top:40px; padding:40px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
    h2 { text-align:center; color:#7a3ff3; margin-bottom:30px; }
    label { font-weight:bold; color:#555; display:block; margin-top:15px; }
    input, select { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:6px; }
    button { background:#7a3ff3; color:white; padding:10px 20px; border:none; border-radius:6px; margin-top:20px; cursor:pointer; }
    button:hover { background:#5e2bd6; }
    .mensagem-sucesso { margin-top:20px; padding:12px; background:#e6ffed; color:#2e7d32; border-left:5px solid #2e7d32; border-radius:6px; }
</style>
</head>

<body>
<div class="container">
    <h2>Cadastro de Agendamento</h2>

    <form method="POST" action="">
        <label>Nome do Paciente:</label>
        <input type="text" name="nome" required>

        <label>Data:</label>
        <input type="date" name="data" required>

        <label>Horário:</label>
        <input type="time" name="hora" required>

        <label>Tipo de Atendimento:</label>
        <select name="tipo" required>
            <option value="">Selecione</option>
            <option>Consulta</option>
            <option>Retorno</option>
            <option>Exame</option>
        </select>

        <button type="submit">Salvar</button>
    </form>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem-sucesso"><?= $mensagem ?></div>
    <?php endif; ?>

</div>
</body>
</html>
