<?php
require_once('../Classes/Agendamento.class.php');

$agendamentos = Agendamento::listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento de Consulta</title>
    <link rel="stylesheet" href="estilo_agendamento.css">
</head>
<body>

    <div class="container">
        <h1>Agendar Consulta</h1>
        <hr class="linha-titulo">

        <?php if (isset($_GET['sucesso'])): ?>
            <p class="mensagem">✅ Agendamento salvo com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($_GET['excluido'])): ?>
            <p class="mensagem">✅ Agendamento excluído com sucesso!</p>
        <?php endif; ?>

        <form action="salvar_agendamento.php" method="POST">

            <div class="linha-dupla">
                <div class="campo">
                    <label for="data">Data</label>
                    <input type="date" name="data" id="data" required>
                </div>

                <div class="campo">
                    <label for="horario">Horário</label>
                    <input type="time" name="horario" id="horario" required>
                </div>
            </div>

            <div class="campo">
                <label for="medico">Nome do Médico</label>
                <input type="text" name="medico" id="medico" required>
            </div>

            <div class="campo">
                <label for="especialidade">Especialidade</label>
                <input type="text" name="especialidade" id="especialidade" required>
            </div>

            <div class="botoes">
                <button type="submit">Agendar</button>
                <button type="reset">Limpar</button>
            </div>
        </form>

        <div class="lista-agendamentos">
            <h2>Consultas Agendadas</h2>
            <ul>
                <?php foreach ($agendamentos as $a): ?>
                    <li>
                        <strong><?= htmlspecialchars($a['data']) ?> às <?= htmlspecialchars($a['hora']) ?></strong> - 
                        <?= htmlspecialchars($a['medico']) ?> (<?= htmlspecialchars($a['especialidade']) ?>)
                        &nbsp;|&nbsp;
                        <a href="excluir_agendamento.php?id=<?= (int)$a['id'] ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir este agendamento?');">
                           Excluir
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>
</html>
