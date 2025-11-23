<?php
// Lista de agendados (exemplo estático)
$agendados = [
    ['nome' => 'Maria Silva', 'data' => '25/11/2025', 'horario' => '14:00'],
    ['nome' => 'João Pereira', 'data' => '26/11/2025', 'horario' => '09:30'],
    ['nome' => 'Ana Costa', 'data' => '27/11/2025', 'horario' => '11:15'],
    ['nome' => 'Ricardo Martins', 'data' => '27/11/2025', 'horario' => '15:45']
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f1fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            width: 750px;
            padding: 30px;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(199, 185, 211, 1);
            border-top: 6px solid rgb(150, 102, 192);
        }

        h1 {
            text-align: center;
            color: rgb(150, 102, 192);
            margin-bottom: 25px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0d7ff;
        }

        th {
            background-color: rgb(150, 102, 192);
            color: white;
        }

        tr:hover {
            background-color: #f2eaff;
        }

        .btn-voltar {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            background-color: rgb(150, 102, 192);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-voltar:hover {
            background-color: rgb(188, 157, 215);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Agendamentos Realizados</h1>

    <table>
        <tr>
            <th>Nome do Paciente</th>
            <th>Data</th>
            <th>Horário</th>
        </tr>

        <?php foreach ($agendados as $agendamento): ?>
            <tr>
                <td><?= $agendamento['nome']; ?></td>
                <td><?= $agendamento['data']; ?></td>
                <td><?= $agendamento['horario']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="../index.php" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
