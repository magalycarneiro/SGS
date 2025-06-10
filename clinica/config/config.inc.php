<?php
// Só define as constantes e cria a conexão se ainda não estiver definido
if (!defined('USUARIO')) {
    define('USUARIO', 'root');
    define('SENHA', '');
    define('HOST', 'localhost');
    define('PORT', '3306');
    define('DB', 'sgs');
    define('DSN', 'mysql:host='.HOST.';port='.PORT.';dbname='.DB);
    define('PATH_UPLOAD', __DIR__.'/uploads/');
}
?>
