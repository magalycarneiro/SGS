<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Prontuario {
    private int $id;
    private string $prescricao;
    private string $observacoes;
    private string $diagnostico;
    private string $mensagemErro;

    public function __construct($id = 0, $prescricao = '', $observacoes = '', $diagnostico = '') {
        $this->id = (int)$id;
        $this->prescricao = $prescricao ?? '';
        $this->observacoes = $observacoes ?? '';
        $this->diagnostico = $diagnostico ?? '';
        $this->mensagemErro = '';
    }

    // Getters
    public function getIdPRONTUARIO(): int {
        return $this->id;
    }

    public function getPrescricao(): string {
        return $this->prescricao ?? '';
    }

    public function getObservacoes(): string {
        return $this->observacoes ?? '';
    }

    public function getDiagnostico(): string {
        return $this->diagnostico ?? '';
    }

    public function getMensagemErro(): string {
        return $this->mensagemErro;
    }

    // Setters
    public function setPrescricao(string $prescricao): void {
        $this->prescricao = $prescricao;
    }

    public function setObservacoes(string $observacoes): void {
        $this->observacoes = $observacoes;
    }

    public function setDiagnostico(string $diagnostico): void {
        $this->diagnostico = $diagnostico;
    }

    public function setIdPRONTUARIO(int $id): void {
        $this->id = $id;
    }

    // Inserir no banco
    public function inserir(): bool {
        $sql = "INSERT INTO prontuario (prescricao, observacoes, diagnostico) 
                VALUES (:prescricao, :observacoes, :diagnostico)";
        
        $params = [
            ':prescricao' => $this->getPrescricao(),
            ':observacoes' => $this->getObservacoes(),
            ':diagnostico' => $this->getDiagnostico()
        ];

        return Database::executar($sql, $params) == true;
    }

    // Alterar registro
    public function alterar(): bool {
        $sql = "UPDATE prontuario 
                   SET prescricao = :prescricao,
                       observacoes = :observacoes,
                       diagnostico = :diagnostico 
                 WHERE idPRONTUARIO = :id";
        
        $params = [
            ':id' => $this->getIdPRONTUARIO(),
            ':prescricao' => $this->getPrescricao(),
            ':observacoes' => $this->getObservacoes(),
            ':diagnostico' => $this->getDiagnostico()
        ];

        return Database::executar($sql, $params) == true;
    }

    // Excluir registro
    public function excluir(): bool {
        $sql = "DELETE FROM prontuario WHERE idPRONTUARIO = :id";
        $params = [':id' => $this->getIdPRONTUARIO()];
        return Database::executar($sql, $params) == true;
    }

    // Listar prontuários
    public static function listar(int $tipo = 0, $info = ''): array {
        $sql = "SELECT * FROM prontuario";
        $params = [];

        switch ($tipo) {
            case 1:
                $sql .= " WHERE idPRONTUARIO = :info";
                $params[':info'] = $info;
                break;
            case 2:
                $sql .= " WHERE prescricao LIKE :info OR observacoes LIKE :info OR diagnostico LIKE :info";
                $params[':info'] = '%' . $info . '%';
                break;
        }

        $comando = Database::executar($sql, $params);
        $lista = [];

        while ($registro = $comando->fetch()) {
            $prontuario = new Prontuario(
                $registro['idPRONTUARIO'] ,
                $registro['PRESCRICAO'] ,
                $registro['OBSERVACOES'],
                $registro['DIAGNOSTICO'] );
            $lista[] = $prontuario;
        }

        return $lista;
    }

    // Método para debug ou exibição
    public function __toString(): string {
        return "Prontuário: {$this->id} - Prescrição: {$this->prescricao} - Observações: {$this->observacoes} - Diagnóstico: {$this->diagnostico}";
    }
}
?>
