<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Prontuário do Paciente</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f4fa;
            margin: 0;
            padding: 0;
        }

        .header {
            background: #693E7F;
            color: #fff;
            padding: 25px 40px;
            font-size: 26px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            font-size: 30px;
            font-weight: normal;
            transition: 0.2s;
        }
        .back-btn:hover {
            color: #C2AAE3;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-left: 8px solid #693E7F;
        }

        .card h2 {
            color: #693E7F;
            margin: 0 0 15px 0;
            font-size: 22px;
        }

        .info-item {
            margin-bottom: 10px;
            font-size: 17px;
        }

        .label {
            font-weight: bold;
            color: #4a2b55;
        }
    </style>

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <div class="header">
        <a class="back-btn" href="../index.php">
            <i class="fas fa-arrow-left"></i>
        </a>
        Prontuário do Paciente
    </div>

    <div class="container">

        <div class="card">
            <h2>Informações do Paciente</h2>
            <div class="info-item"><span class="label">Nome:</span> Magaly B. Carneiro</div>
        </div>

        <div class="card">
            <h2>Atestado</h2>
            <div class="info-item">Não há atestado emitido para este atendimento.</div>
        </div>

        <div class="card">
            <h2>Prescrição</h2>
            <div class="info-item">Paracetamol 500mg — tomar 1 comprimido a cada 8 horas por 3 dias. Hidratação adequada (mínimo 2 litros/dia). Repouso relativo.</div>
        </div>

        <div class="card">
            <h2>Observações</h2>
            <div class="info-item">A paciente apresenta leve desconforto, sem febre. Orientada quanto aos sinais de alerta.</div>
        </div>

        <div class="card">
            <h2>Diagnóstico</h2>
            <div class="info-item">Quadro inespecífico de dor de cabeça sem sinais neurológicos.</div>
        </div>

        <div class="card">
            <h2>Encaminhamento</h2>
            <div class="info-item">-</div>
        </div>

        <div class="card">
            <h2>Antecedentes</h2>
            <div class="info-item">Sem alergias conhecidas.
Histórico de episódios esporádicos de cefaleia leve.</div>
        </div>

        <div class="card">
            <h2>Exames</h2>
            <div class="info-item">-</div>
        </div>

    </div>

</body>
</html>
