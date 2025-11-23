<?php
require_once(__DIR__ . '/../../config/conexao.php');

class Configuracoes {
    public static function carregar() {
        $conexao = Conexao::getConexao();
        $sql = "SELECT * FROM configuracoes LIMIT 1";
        $stmt = $conexao->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            self::salvar(true, 'claro');
            return ['notificacoes' => true, 'tema' => 'claro'];
        }

        return $resultado;
    }

    public static function salvar($notificacoes, $tema) {
        $conexao = Conexao::getConexao();
        $sql = "DELETE FROM configuracoes";
        $conexao->exec($sql);

        $sql = "INSERT INTO configuracoes (notificacoes, tema) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$notificacoes, $tema]);
    }
}
