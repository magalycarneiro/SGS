<?php
require_once(__DIR__ . '/../Classes/Atestado.class.php');

// Mensagens de feedback
$mensagem = '';
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = '<div class="alert success">Atestado gerado com sucesso! ID: ' . htmlspecialchars($_GET['id']) . '</div>';
}

if (isset($_GET['erro'])) {
    $mensagem = '<div class="alert error">' . htmlspecialchars($_GET['erro']) . '</div>';
}

// Obtém a lista de atestados
try {
    $atestados = Atestado::listarTodos();
} catch (Exception $e) {
    $mensagem = '<div class="alert error">Erro ao carregar atestados: ' . htmlspecialchars($e->getMessage()) . '</div>';
    $atestados = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Atestados Médicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #693E7F;
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #935CC4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
            display: inline-block;
        }
        .btn-primary {
            background-color: #935CC4;
            color: white;
            margin-bottom: 20px;
        }
        .btn-primary:hover {
            background-color: #693E7F;
        }
        .btn-view {
            background-color: #A56ACB;
            color: white;
        }
        .btn-view:hover {
            background-color: #935CC4;
        }
        .btn-edit {
            background-color: #B579DC;
            color: white;
        }
        .btn-edit:hover {
            background-color: #A56ACB;
        }
        .btn-delete {
            background-color: #d9534f;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c9302c;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Atestados Médicos</h1>
        
        <?php echo $mensagem; ?>
        
        <div>
            <a href="form_cad_atestado.html" class="btn btn-primary">Novo Atestado</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Data</th>
                    <th>CID</th>
                    <th>Dias</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($atestados) > 0): ?>
                    <?php foreach ($atestados as $atestado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($atestado['id']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['paciente']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['medico']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($atestado['data'])); ?></td>
                            <td><?php echo htmlspecialchars($atestado['cid']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['dias']); ?></td>
                            <td class="actions">
                                <a href="pdfs/Atestado_<?php echo $atestado['id']; ?>.pdf" target="_blank" class="btn btn-view">Visualizar</a>
                                <a href="editar_atestado.php?id=<?php echo $atestado['id']; ?>" class="btn btn-edit">Editar</a>
                                <a href="excluir_atestado.php?id=<?php echo $atestado['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este atestado?')" class="btn btn-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Nenhum atestado cadastrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Adiciona confirmação antes de excluir
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja excluir este atestado?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html><?php
require_once(__DIR__ . '/../Classes/Atestado.class.php');

// Mensagens de feedback
$mensagem = '';
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = '<div class="alert success">Atestado gerado com sucesso! ID: ' . htmlspecialchars($_GET['id']) . '</div>';
}

if (isset($_GET['erro'])) {
    $mensagem = '<div class="alert error">' . htmlspecialchars($_GET['erro']) . '</div>';
}

// Obtém a lista de atestados
try {
    $atestados = Atestado::listarTodos();
} catch (Exception $e) {
    $mensagem = '<div class="alert error">Erro ao carregar atestados: ' . htmlspecialchars($e->getMessage()) . '</div>';
    $atestados = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Atestados Médicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #693E7F;
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #935CC4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
            display: inline-block;
        }
        .btn-primary {
            background-color: #935CC4;
            color: white;
            margin-bottom: 20px;
        }
        .btn-primary:hover {
            background-color: #693E7F;
        }
        .btn-view {
            background-color: #A56ACB;
            color: white;
        }
        .btn-view:hover {
            background-color: #935CC4;
        }
        .btn-edit {
            background-color: #B579DC;
            color: white;
        }
        .btn-edit:hover {
            background-color: #A56ACB;
        }
        .btn-delete {
            background-color: #d9534f;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c9302c;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Atestados Médicos</h1>
        
        <?php echo $mensagem; ?>
        
        <div>
            <a href="form_cad_atestado.html" class="btn btn-primary">Novo Atestado</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Data</th>
                    <th>CID</th>
                    <th>Dias</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($atestados) > 0): ?>
                    <?php foreach ($atestados as $atestado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($atestado['id']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['paciente']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['medico']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($atestado['data'])); ?></td>
                            <td><?php echo htmlspecialchars($atestado['cid']); ?></td>
                            <td><?php echo htmlspecialchars($atestado['dias']); ?></td>
                            <td class="actions">
                                <a href="pdfs/Atestado_<?php echo $atestado['id']; ?>.pdf" target="_blank" class="btn btn-view">Visualizar</a>
                                <a href="editar_atestado.php?id=<?php echo $atestado['id']; ?>" class="btn btn-edit">Editar</a>
                                <a href="excluir_atestado.php?id=<?php echo $atestado['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este atestado?')" class="btn btn-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Nenhum atestado cadastrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Adiciona confirmação antes de excluir
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja excluir este atestado?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>