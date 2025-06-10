<?php
session_start();

// Simulação de banco de dados de usuários
$usuarios = [
    'admin' => [
        'senha' => 'admin',
        'tipo' => 'admin',
        'nome' => 'Administrador'
    ],
    'medico1' => [
        'senha' => 'medico123',
        'tipo' => 'medico',
        'nome' => 'Dr. João Silva',
        'especialidade' => 'Cardiologia'
    ],
    'secretaria1' => [
        'senha' => 'secretaria123',
        'tipo' => 'secretaria',
        'nome' => 'Maria Souza'
    ],
    'paciente1' => [
        'senha' => 'paciente123',
        'tipo' => 'paciente',
        'nome' => 'Carlos Oliveira',
        'prontuario' => 'P12345'
    ]
];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $selected_type = $_POST['user_type'] ?? 'paciente';

    // Verifica se o usuário existe e a senha está correta
    if (isset($usuarios[$username]) && $usuarios[$username]['senha'] === $password && $usuarios[$username]['tipo'] === $selected_type) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userdata'] = $usuarios[$username];
        
        // Redireciona conforme o tipo de usuário
        switch ($usuarios[$username]['tipo']) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'medico':
                header("Location: ../SGS/clinica/medico/index.php");  
                break;
            case 'secretaria':
                header("Location: ../SGS/clinica/secretaria/index.php");
                break;
            case 'paciente':
                header("Location: clinica/paciente.php");
                break;
            default:
                header("Location: index.php");
        }
        exit;
    } else {
        $error = "Credenciais inválidas!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Médica</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('clinica-bg.jpg');
            background-size: cover;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            border-top: 5px solid #5f0099;
        }
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo img {
            height: 80px;
        }
        .form-title {
            text-align: center;
            color: #5f0099;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #5f0099;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #5f0099;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #5f0099;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 1rem;
            text-align: center;
            padding: 0.5rem;
            background-color: #f8d7da;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }
        .user-type-selector {
            display: flex;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        .user-type {
            flex: 1;
            text-align: center;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            border-right: 1px solid #ddd;
        }
        .user-type:last-child {
            border-right: none;
        }
        .user-type.active {
            background-color: #5f0099;
            color: white;
        }
        .user-type:hover {
            background-color: #e7f1ff;
        }
        .user-type.active:hover {
            background-color: #5f0099;
        }
        .footer-links {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .footer-links a {
            color: #5f0099;
            text-decoration: none;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="img/logo3.png" alt="Clínica Médica">
        </div>
        
        <h2 class="form-title">Acesso ao Sistema</h2>
        
        <div class="user-type-selector">
            <div class="user-type active" data-type="paciente">Paciente</div>
            <div class="user-type" data-type="medico">Médico</div>
            <div class="user-type" data-type="secretaria">Clínica</div>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" id="user_type" name="user_type" value="paciente">
            
            <div class="form-group">
                <label for="email" id="user-label">Usuário</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu usuário" required>
            </div>
            
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            
            <button type="submit" class="btn">Entrar</button>
        </form>
        
        <script src="javascript/login.js"></script>
        
    </div>
</body>
</html>