<?php
require_once(__DIR__ . '/../Classes/Atestado.class.php');

$id = $_GET['id'] ?? null;
$atestado = Atestado::buscarPorId($id);

if (!$atestado) {
    header("Location: form_cad_atestado.html?erro=Atestado não encontrado");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Atestado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        iframe {
            width: 100%;
            height: 500px;
            border: none;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #693E7F;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }
        .btn:hover {
            background-color: #5a3470;
        }
        .success-message {
            display: none;
            padding: 20px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function imprimirAtestado() {
            // Simula a impressão
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'block';
                document.getElementById('btn-imprimir').style.display = 'none';
            }, 1000);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Atestado Médico</h1>
        
        <iframe src="pdfs/Atestado_<?= $id ?>.pdf"></iframe>
        
        <button id="btn-imprimir" class="btn" onclick="imprimirAtestado()">Imprimir Atestado</button>
        
        <div id="success-message" class="success-message">
            <p>Atestado impresso com sucesso!</p>
           <a href="../index.php" class="btn">Voltar</a>
        </div>
    </div>
</body>
</html>