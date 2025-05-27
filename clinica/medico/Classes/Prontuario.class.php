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
    $observacoes = '', $diagnostico = '', $atestado = '', $encaminhamentos = '',
    $antecedentes = '', $solicitacaoexames = '', $exames = '') {
        $this->id = (int)$id;
        $this->prescricao = $prescricao ?? '';
        $this->nomepaciente = $nomepaciente ?? '';
        $this->observacoes = $observacoes ?? '';
        $this->diagnostico = $diagnostico ?? '';
        $this->atestado = $atestado ?? '';
        $this->encaminhamentos = $encaminhamentos ?? '';
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
        $sql = "INSERT INTO prontuario (nomepaciente, prescricao, observacoes, diagnostico, atestado,
        encaminhamento, antecedentes, solicitacaoexames, exames) 
                VALUES (:prescricao, :observacoes, :diagnostico, :atestado, :encaminhamento, :antecedentes,
                :solicitacaoexames, :exames)";
        
        $params = [
            ':nomepaciente' => $this->getNomepaciente(),
            ':prescricao' => $this->getPrescricao(),
            ':observacoes' => $this->getObservacoes(),
            ':diagnostico' => $this->getDiagnostico(),
            ':atestado' => $this->getAtestado(),
            ':encaminhamento' => $this->getEncaminhamento(),
            ':antecedentes' => $this->getAntecedentes(),
            ':solicitacaoexames' => $this->getSolicitacaoexames(),
            ':exames' => $this->getExames()
        ];

        return Database::executar($sql, $params) == true;
    }

    // Alterar registro
    public function alterar(): bool {
        $sql = "UPDATE prontuario 
                   SET nomepaciente = :nomepaciente,
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
    ':id' => $this->getIdprontuario(),
    ':nomepaciente' => $this->getNomePaciente(),
    ':prescricao' => $this->getPrescricao(),
    ':observacoes' => $this->getObservacoes(),
    ':diagnostico' => $this->getDiagnostico(),
    ':atestado' => $this->getAtestado(),
    ':encaminhamento' => $this->getEncaminhamento(),
    ':antecedentes' => $this->getAntecedentes(),
    ':solicitacaoexames' => $this->getSolicitacaoExames(),
    ':exames' => $this->getExames()
];

        return Database::executar($sql, $params) == true;
    }

    // Excluir registro
    public function excluir(): bool {
        $sql = "DELETE FROM prontuario WHERE idprontuario = :id";
        $params = [':id' => $this->getIdprontuario()];
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
                $sql .= " WHERE prescricao LIKE :info OR observacoes LIKE :info OR diagnostico LIKE :info OR 
                atestado LIKE :info OR encaminhamento LIKE :info OR antecedente LIKE :info
                OR solicitacaoexame LIKE :info OR exames LIKE :info OR nomepaciente LIKE :info";
                $params[':info'] = '%' . $info . '%';
                break;
        }

        $comando = Database::executar($sql, $params);
        $lista = [];

        while ($registro = $comando->fetch()) {
            $prontuario = new Prontuario((
                $registro['idprontuario'] ,

                $registro['nomepaciente'] ,
                $registro['prescricao'] ,
                $registro['observacoes'],
                $registro['diagnostico'],
                $registro['encaminhamentos'] ,
                $registro['antecedentes'] ,
                $registro['atestado'] ,
                $registro['solicitacaoexame'] ,
                $registro['exames'] );

                $registro['prescricao'] ,
                $registro['observacoes'],
                $registro['diagnostico'] );

            $lista[] = $prontuario;
        }

        return $lista;
    }

    // Método para debug ou exibição
    public function __toString(): string {
        return "Prontuário: {$this->id} - Nome: {$this->nomepaciente} - Prescrição: {$this->prescricao} - Observações: {$this->observacoes} - Diagnóstico: {$this->diagnostico} - Atestado: {$this->atestado} - Encaminhamento: {$this->encaminhamento} - Antecedentes: {$this->antecedentes} - Solicitação de Exames: {$this->solicitacaoexames} - Exames: {$this->exames}";

    }
}
?>