<?php
include(__DIR__ . '/../config/config.inc.php');

class Database {
    private static $conexao = null;

    private static function abrirConexao() {
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO(DSN, USUARIO, SENHA);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch(PDOException $e) {
                error_log("Erro na conexão com o banco: " . $e->getMessage());
                throw new Exception("Falha na conexão com o banco de dados. Por favor, tente novamente mais tarde.");
            }
        }
        return self::$conexao;
    }

    private static function preparar($sql) {
        $conexao = self::abrirConexao();
        try {
            return $conexao->prepare($sql);
        } catch(PDOException $e) {
            error_log("Erro ao preparar SQL: " . $e->getMessage() . " - Query: " . $sql);
            throw new Exception("Erro ao processar a requisição: " . $e->getMessage());
        }
    }

    private static function vincularParametros($comando, $parametros) {
        foreach($parametros as $chave => $valor) {
            $tipo = is_int($valor) ? PDO::PARAM_INT : 
                   (is_bool($valor) ? PDO::PARAM_BOOL : 
                   (is_null($valor) ? PDO::PARAM_NULL : PDO::PARAM_STR));
            
            $comando->bindValue($chave, $valor, $tipo);
        }
        return $comando;
    }

    public static function executar($sql, $parametros = array()) {
        try {
            $comando = self::preparar($sql);
            $comando = self::vincularParametros($comando, $parametros);
            $comando->execute();
            return $comando;
        } catch(PDOException $e) {
            error_log("Erro ao executar SQL: " . $e->getMessage() . 
                     " - Query: " . $sql . 
                     " - Parâmetros: " . print_r($parametros, true));
            throw new Exception("Erro ao processar a operação no banco de dados: " . $e->getMessage());
            error_log("SQL: " . $sql);
error_log("Params: " . print_r($parametros, true));
        }
    }

    public static function getLastInsertId() {
        $conexao = self::abrirConexao();
        return $conexao->lastInsertId();
    }
}
?>
