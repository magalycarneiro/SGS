<?php
define('DSN', 'mysql:host=localhost;dbname=SGS;charset=utf8'); // ou 'sgs', dependendo de como está no phpMyAdmin
define('USUARIO', 'root');
define('SENHA', '');

try {
    $pdo = new PDO(DSN, USUARIO, SENHA);
    echo "✅ Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $e) {
    die("❌ Erro na conexão: " . $e->getMessage());
}
