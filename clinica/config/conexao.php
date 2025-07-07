<?php
class Conexao {
    public static function getConexao() {
        $host = 'localhost';      // ou o host do seu MySQL
        $dbname = 'sgs';          // o nome do banco criado
        $usuario = 'root';        // usuário do MySQL, padrão no XAMPP é root
        $senha = '';              // senha do MySQL, padrão no XAMPP é vazia

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
            // Configura o modo de erro do PDO para exceção
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
?>
    