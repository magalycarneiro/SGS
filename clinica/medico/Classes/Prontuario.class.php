<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Prontuario {
    private int $id;
    private string $nomepaciente;
    private string $prescricao;
    private string $observacoes;
    private string $diagnostico;
    private string $atestado;
    private string $encaminhamento;
    private string $antecedentes;
    private string $solicitacaoexames;
    private string $exames;
    private string $mensagemErro;

    public function __construct($id = 0, $nomepaciente = '', $prescricao = '', 
    $observacoes = '', $diagnostico = '', $atestado = '', $encaminhamento = '',
    $antecedentes = '', $solicitacaoexames = '', $exames = '') {
        $this->id = (int)$id;
        $this->prescricao = $prescricao ?? '';
        $this->nomepaciente = $nomepaciente ?? '';
        $this->observacoes = $observacoes ?? '';
        $this->diagnostico = $diagnostico ?? '';
        $this->atestado = $atestado ?? '';
        $this->encaminhamento = $encaminhamento ?? '';
        $this->antecedentes = $antecedentes ?? '';
        $this->solicitacaoexames = $solicitacaoexames ?? '';
        $this->exames = $exames ?? '';
        $this->mensagemErro = '';
    }

    // Getters
    public function getIdPRONTUARIO(): int {
        return $this->id;
    }

    public function getNomepaciente(): string {
        return $this->nomepaciente ?? '';
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

    public function getAtestado(): string {
        return $this->atestado ?? '';
    }

    public function getEncaminhamento(): string {
        return $this->encaminhamento ?? '';
    }

    public function getAntecedentes(): string {
        return $this->antecedentes ?? '';
    }

    public function getSolicitacaoexames(): string {
        return $this->solicitacaoexames ?? '';
    }

    public function getExames(): string {
        return $this->exames ?? '';
    }

    public function getMensagemErro(): string {
        return $this->mensagemErro;
    }

    // Setters
    public function setNomepaciente(string $nomepaciente): void {
        $this->nomepaciente = $nomepaciente;
    }

    public function setPrescricao(string $prescricao): void {
        $this->prescricao = $prescricao;
    }

    public function setObservacoes(string $observacoes): void {
        $this->observacoes = $observacoes;
    }

    public function setDiagnostico(string $diagnostico): void {
        $this->diagnostico = $diagnostico;
    }

    public function setAtestado(string $atestado): void {
        $this->atestado = $atestado;
    }

    public function setEncaminhamento(string $encaminhamento): void {
        $this->encaminhamento = $encaminhamento;
    }

    public function setAntecedentes(string $antecedentes): void {
        $this->antecedentes = $antecedentes;
    }

    public function setSolicitacaoexames(string $solicitacaoexames): void {
        $this->solicitacaoexames = $solicitacaoexames;
    }

    public function setExames(string $exames): void {
        $this->exames = $exames;
    }

    public function setIdPRONTUARIO(int $id): void {
        $this->id = $id;
    }

    // Inserir no banco
    public function inserir(): bool {
    $sql = "INSERT INTO prontuario 
            (nomepaciente, prescricao, observacoes, diagnostico, atestado,
             encaminhamento, antecedentes, solicitacaoexames, exames) 
            VALUES 
            (:nomepaciente, :prescricao, :observacoes, :diagnostico, :atestado, 
             :encaminhamento, :antecedentes, :solicitacaoexames, :exames)";
    
    $params = [
        ':nomepaciente' => $this->getNomepaciente(),
        ':prescricao' => $this->getPrescricao(),
        ':observacoes' => $this->getObservacoes(),
        ':diagnostico' => $this->getDiagnostico() ?: null,
        ':atestado' => $this->getAtestado() ?: null,
        ':encaminhamento' => $this->getEncaminhamento() ?: null,
        ':antecedentes' => $this->getAntecedentes() ?: null,
        ':solicitacaoexames' => $this->getSolicitacaoexames() ?: null,
        ':exames' => $this->getExames() ?: null
    ];

    error_log("Tentativa de inserção: " . print_r($params, true));

    try {
        $stmt = Database::executar($sql, $params);
        
        if ($stmt !== false && $stmt->rowCount() > 0) {
            $this->id = Database::getLastInsertId();
            error_log("Inserção bem-sucedida. ID: " . $this->id);
            return true;
        }
        
        error_log("Nenhuma linha afetada na inserção");
        $this->mensagemErro = "Nenhum registro foi inserido";
        return false;
        
    } catch (Exception $e) {
        $this->mensagemErro = $e->getMessage();
        error_log("Erro na inserção: " . $e->getMessage());
        return false;
    }
}

    // Alterar registro
   public function alterar(): bool {
    $sql = "UPDATE prontuario SET 
               nomepaciente = :nomepaciente,
               prescricao = :prescricao,
               observacoes = :observacoes,
               diagnostico = :diagnostico,
               atestado = :atestado,
               encaminhamento = :encaminhamento,
               antecedentes = :antecedentes,
               solicitacaoexames = :solicitacaoexames,
               exames = :exames
            WHERE idprontuario = :id";
    
    $params = [
        ':id' => $this->id,
        ':nomepaciente' => $this->nomepaciente,
        ':prescricao' => $this->prescricao,
        ':observacoes' => $this->observacoes,
        ':diagnostico' => $this->diagnostico,
        ':atestado' => $this->atestado,
        ':encaminhamento' => $this->encaminhamento,
        ':antecedentes' => $this->antecedentes,
        ':solicitacaoexames' => $this->solicitacaoexames,
        ':exames' => $this->exames
    ];

    try {
        $stmt = Database::executar($sql, $params);
        return $stmt !== false && $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        $this->mensagemErro = $e->getMessage();
        return false;
    }
}



    // Excluir registro
    
    public function excluir(): bool {
    $sql = "DELETE FROM prontuario WHERE idprontuario = :id";
    $params = [':id' => $this->getIdPRONTUARIO()];
    
    try {
        $stmt = Database::executar($sql, $params);
        return $stmt !== false && $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        $this->mensagemErro = $e->getMessage();
        return false;
    }
}

    // Listar prontuários
 public static function listar(int $tipo = 0, $info = ''): array {
    $sql = "SELECT * FROM prontuario";
    $params = [];

    try {
        // Validação dos parâmetros
        if ($tipo === 1 && !is_numeric($info)) {
            throw new InvalidArgumentException("Para busca por ID, o termo deve ser numérico");
        }

        // Construção da consulta
        if ($tipo === 1) {
            // Busca por ID
            $sql .= " WHERE idPRONTUARIO = :id";
            $params[':id'] = (int)$info;
        } elseif ($tipo === 2 && !empty(trim($info))) {
            // Busca textual simplificada - usando um único parâmetro
            $sql .= " WHERE nomepaciente LIKE :termo";
            $params[':termo'] = '%' . trim($info) . '%';
        }

        // Debug (remova em produção)
        error_log("SQL: " . $sql);
        error_log("Params: " . print_r($params, true));

        $comando = Database::executar($sql, $params);
        $lista = [];

        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $prontuario = new Prontuario(
                $registro['idprontuario'] ?? 0,
                $registro['nomepaciente'] ?? '',
                $registro['prescricao'] ?? '',
                $registro['observacoes'] ?? '',
                $registro['diagnostico'] ?? '',
                $registro['atestado'] ?? '',
                $registro['encaminhamento'] ?? '',
                $registro['antecedentes'] ?? '',
                $registro['solicitacaoexames'] ?? '',
                $registro['exames'] ?? ''
            );
            $lista[] = $prontuario;
        }

        return $lista;

    } catch (PDOException $e) {
        error_log("Erro PDO: " . $e->getMessage());
        throw new Exception("Erro ao buscar prontuários: " . $e->getMessage());
    }
}
    // Método para debug ou exibição
    public function __toString(): string {
        return "Prontuário: {$this->id} - Nome: {$this->nomepaciente} - Prescrição: {$this->prescricao} - Observações: {$this->observacoes} - Diagnóstico: {$this->diagnostico} - Atestado: {$this->atestado} - Encaminhamento: {$this->encaminhamento} - Antecedentes: {$this->antecedentes} - Solicitação de Exames: {$this->solicitacaoexames} - Exames: {$this->exames}";
    }
}
?>