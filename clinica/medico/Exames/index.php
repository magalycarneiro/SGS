<?php
$exames = [
     [
        'paciente' => 'Magaly B. Carneiro',
        'tipoExame' => 'Hemograma Completo',
        'data' => '25/06/2025'
    ],
    [
        'paciente' => 'Magaly B. Carneiro',
        'tipoExame' => 'Raio-X Tórax',
        'data' => '20/06/2025'
    ],
    [
        'paciente' => 'Maria Silva',
        'tipoExame' => 'Radiografia',
        'data' => '12/11/2025'
    ],
    [
        'paciente' => 'João Pereira',
        'tipoExame' => 'Hemograma Completo',
        'data' => '05/11/2025'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exames Realizados</title>
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
            width: 650px;
            padding: 25px;
            margin-top: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(140, 82, 255, 0.2);
            border-top: 6px solid #693E7F;
        }

        h1 {
            text-align: center;
            color:#693E7F;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .exame-card {
            padding: 15px;
            margin-bottom: 15px;
            background: #f8f5ff;
            border: 1px solid #e5dbff;
            border-radius: 8px;
        }

        .label {
            font-weight: bold;
            color: #693E7F;
        }

        .btn-voltar {
            display: block;
            text-align: center;
            margin-top: 25px;
            text-decoration: none;
            background-color:#693E7F;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
            background-color:#693E7F;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Exames Cadastrados</h1>

    <?php foreach ($exames as $exame): ?>
        <div class="exame-card">
            <div><span class="label">Paciente:</span> <?= $exame['paciente']; ?></div>
            <div><span class="label">Tipo de Exame:</span> <?= $exame['tipoExame']; ?></div>
            <div><span class="label">Data:</span> <?= $exame['data']; ?></div>
        </div>
    <?php endforeach; ?>

    <a href="../index.php" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
