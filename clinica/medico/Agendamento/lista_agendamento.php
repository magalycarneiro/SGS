<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SGS/SGS/clinica/config/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SGS/SGS/clinica/medico/Classes/Agendamento.class.php';

// Verificando se a conexão existe
if (!isset($pdo)) {
    die("Erro: conexão com o banco de dados não estabelecida.");
}

// Instanciando a classe corretamente
$agendamento = new Agendamento($pdo);
$resultado = $agendamento->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Agendamentos</title>

<style>
body { 
    background: #f7f4fb; 
    font-family: Arial, sans-serif; 
    display: flex; 
    justify-content: center; 
}
.container { 
    background: #fff; 
    width: 80%; 
    margin-top: 40px; 
    padding: 40px; 
    border-radius:12px; 
    box-shadow:0 5px 15px rgba(0,0,0,0.1); 
}
h2 { 
    text-align:center; 
    color:#7a3ff3; 
    margin-bottom:30px; 
}
table { 
    width:100%; 
    border-collapse: collapse; 
}
th, td { 
    padding: 12px; 
    border-bottom: 1px solid #ddd; 
    text-align: left; 
}
th { 
    background: #7a3ff3; 
    color:white; 
}
tr:hover { 
    background-color: #f2eaff; 
}
.btn { 
    display:inline-block; 
    background:#a077ff; 
    color:white; 
    padding:10px 20px; 
    text-decoration:none; 
    border-radius:6px; 
    margin-top:20px; 
}
</style>
</head>

<body>
<div class="container">
<h2>Lista de Agendamentos</h2>

<?php if (isset($_GET['sucesso'])): ?>
    <p style="color:green;">Agendamento cadastrado com sucesso!</p>
<?php endif; ?>

<?php include 'itens_listagem_agendamento.html'; ?>

<br>
<a href="index.php" class="btn">Voltar</a>
</div>
</body>
</html>
