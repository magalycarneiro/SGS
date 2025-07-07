<?php
require_once(__DIR__ . '/../../config/conexao.php');

class Atendimento {
    private $data;
    private $tipo;
    private $obs;

    public function __construct($data, $tipo, $obs) {
        $this->data = $data;
        $this->tipo = $tipo;
        $this->obs = $obs;
    }

    public function getInfo() {
        return "{$this->data} - {$this->tipo}: {$this->obs}";
    }

    public static function listarTodos() {
        try {
            $conexao = Conexao::getConexao();
            $sql = "SELECT * FROM atendimentos ORDER BY data DESC";
            $stmt = $conexao->query($sql);
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $lista = [];
            foreach ($registros as $r) {
                $lista[] = new Atendimento($r['data'], $r['tipo'], $r['obs']);
            }
            return $lista;
        } catch (PDOException $e) {
            die("Erro ao buscar atendimentos: " . $e->getMessage());
        }
    }

    public static function salvar($data, $tipo, $obs) {
        try {
            $conexao = Conexao::getConexao();
            $sql = "INSERT INTO atendimentos (data, tipo, obs) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$data, $tipo, $obs]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao salvar atendimento: " . $e->getMessage());
        }
    }
}
