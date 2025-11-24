<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Paciente</title>
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
    <h1>Cadastro de Paciente</h1>

<form action="paciente.php" method="post">
    <fieldset>
        <legend>Formulário de Cadastro</legend>

        <div class="form-group">
            <div class="form-field">
                <label for="idconsulta">Código do(a) paciente:</label>
                <input type="text" name="idpaciente" readonly 
                       value="{idpaciente}">
            </div>

            <div class="form-field">
                <label for="nome">Nome completo do(a) paciente</label>                  
                <input type="text" name="nome" value="{nome}">
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="cpf">CPF do(a) paciente:</label>
                <input type="text" name="cpf" value="{cpf}">
            </div>

            <div class="form-field">
                <label for="endereco">Endereço do paciente:</label>
                <input type="text" name="endereco" value="{endereco}">
            </div>
            </div>

            <div class="form-group">
            <div class="form-field">
                <label for="telefone">Telefone/celular para contato:</label>
                <input type="text" name="telefone" value="{telefone}">
            </div>

        <div class="form-field">
                <label for="email">E-mail para contato:</label>
                <input type="text" name="email" value="{email}">
            </div>
        </div>

        <div class="form-group">
        <div class="form-field">
                <label for="data_nascimento">Data de nascimento:</label>
                <input type="date" name="data_nascimento" value="{data_nascimento}">
            </div>
        </div>


        <div class="button-group">
            <button type="submit" name="acao" value="salvar">Cadastrar Paciente</button>
            <button type="submit" name="acao" value="excluir">Cancelar Cadastro</button>
            <input type="reset" value="Limpar Campos">
        </div>

        <div class="button-group">
            <a href="lista_paciente.php"
               style="padding:10px 16px;border-radius:6px;background:#bdc3c7;color:#000;text-decoration:none;font-weight:bold;">
               Ver Pacientes
            </a>
        </div>

    </fieldset>
</form>


</body>
</html>
