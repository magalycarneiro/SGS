<?php
include_once('../includes/tema.php');
require_once('../Classes/Agendamento.class.php');

$agendamentos = Agendamento::listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento de Consulta</title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-dark: #693E7F;
            --primary: #935CC4;
            --primary-light: #A56ACB;
            --primary-lighter: #B579DC;
            --primary-lightest: #C2AAE3;
            --text-on-primary: #FFFFFF;
            --background-claro: #F8F9FA;
            --background-escuro: #1E1E1E;
            --card-background-claro: #FFFFFF;
            --card-background-escuro: #2C2C2C;
            --text-color-claro: #212529;
            --text-color-escuro: #E5E5E5;
            --border-color: #E9ECEF;
        }

        body {
            background-color: <?= $background ?>;
            color: <?= $textColor ?>;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .container {
            background-color: <?= $cardBg ?>;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
            border: 1px solid var(--border-color);
        }

        h1, h2 {
            color: var(--primary-dark);
        }

        .mensagem {
            color: green;
            font-weight: bold;
            margin: 15px 0;
        }

        .campo {
            margin-bottom: 15px;
        }

        .linha-dupla {
            display: flex;
            gap: 20px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
        }

        .botoes {
            margin-top: 20px;
        }

        button {
            background-color: var(--primary);
            color: var(--text-on-primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        button:hover {
            background-color: var(--primary-dark);
        }

        .lista-agendamentos ul {
            list-style: none;
            padding-left: 0;
        }

        .lista-agendamentos li {
            background-color: <?= $cardBg ?>;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .lista-agendamentos a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: bold;
        }

        .lista-agendamentos a:hover {
            text-decoration: underline;
        }
    </style>
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