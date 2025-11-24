<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento de Consulta Médica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4B2C73;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #4B2C73;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-field {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #4B2C73;
        }

        input[type="text"],
        input[type="datetime-local"],
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #faf8fc;
            font-size: 1em;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }

        button,
        input[type="reset"] {
            padding: 10px 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
        }

        button[name="acao"][value="salvar"] {
            background-color: #8e44ad;
            color: white;
        }

        button[name="acao"][value="excluir"] {
            background-color: #7f8c8d;
            color: white;
        }

        input[type="reset"] {
            background-color: #bdc3c7;
            color: black;
        }

        button:hover,
        input[type="reset"]:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h1>Agendamento de Consulta Médica</h1>

<form action="consulta.php" method="post">
    <fieldset>
        <legend>Formulário de Agendamento</legend>

        <div class="form-group">
            <div class="form-field">
                <label for="idconsulta">Código da Consulta:</label>
                <input type="text" name="idconsulta" readonly 
                       value="{idconsulta}">
            </div>

            <div class="form-field">
                <label for="status">Status da consulta</label>
                <select name="status" id="status">
                    <option value="1" {status1}>Confirmada</option>
                    <option value="2" {status2}>Não confirmada</option>
                </select>                    
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="idpaciente">Paciente:</label>
                <input type="text" name="idpaciente" value="{idpaciente}">
            </div>

            <div class="form-field">
                <label for="idmedico">Médico(a):</label>
                <input type="text" name="idmedico" value="{idmedico}">
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="data_hora">Data e Horário:</label>
                <input type="datetime-local" name="data_hora" value="{data_hora}">
            </div>
        </div>

        <div class="button-group">
            <button type="submit" name="acao" value="salvar">Agendar Consulta</button>
            <button type="submit" name="acao" value="excluir">Cancelar Consulta</button>
            <input type="reset" value="Limpar Campos">
        </div>

        <div class="button-group">
            <a href="lista_consulta.php"    
               style="padding:10px 16px;border-radius:6px;background:#bdc3c7;color:#000;text-decoration:none;font-weight:bold;">
               Ver Consultas
            </a>
        </div>

    </fieldset>
</form>


</body>
</html>
