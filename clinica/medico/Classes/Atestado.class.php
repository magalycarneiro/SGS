<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Atestado {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $cid;
    private $dias;
    private $observacoes;

    // Getters e Setters
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    
    public function setPaciente($paciente) { $this->paciente = $patient; }
    public function getPaciente() { return $this->paciente; }
    
    public function setMedico($medico) { $this->medico = $medico; }
    public function getMedico() { return $this->medico; }
    
    public function setData($data) { $this->data = $data; }
    public function getData() { return $this->data; }
    
    public function setCid($cid) { $this->cid = $cid; }
    public function getCid() { return $this->cid; }
    
    public function setDias($dias) { $this->dias = $dias; }
    public function getDias() { return $this->dias; }
    
    public function setObservacoes($observacoes) { $this->observacoes = $observacoes; }
    public function getObservacoes() { return $this->observacoes; }

    // Salva o atestado no banco de dados
    public function salvar() {
        $sql = "INSERT INTO atestados 
                (paciente, medico, data, cid, dias, observacoes) 
                VALUES 
                (:paciente, :medico, :data, :cid, :dias, :observacoes)";
        
        $params = [
            ':paciente' => $this->paciente,
            ':medico' => $this->medico,
            ':data' => $this->data,
            ':cid' => $this->cid,
            ':dias' => $this->dias,
            ':observacoes' => $this->observacoes
        ];
        
        try {
            Database::executar($sql, $params);
            $this->id = Database::getLastInsertId();
            return $this->id;
        } catch (Exception $e) {
            error_log("Erro ao salvar atestado: " . $e->getMessage());
            throw new Exception("Não foi possível salvar o atestado.");
        }
    }

    // Gera o PDF do atestado (mantido igual)
    public function gerarPDF() {
        require_once(dirname(__DIR__) . '/lib/tcpdf/tcpdf.php');
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Saúde');
        $pdf->SetTitle('Atestado Médico');
        
        $pdf->setHeaderData('', 0, 'Atestado Médico', '', array(105, 62, 196), array(105, 62, 196));
        $pdf->setFooterData(array(0,0,0), array(0,0,0));
        
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(15, 25, 15);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        $pdf->AddPage();
        
        // Conteúdo do PDF
        $html = '
        <style>
            .titulo { color: #693E7F; font-size: 18px; font-weight: bold; text-align: center; margin-bottom: 20px; }
            .conteudo { font-size: 14px; line-height: 1.6; }
            .assinatura { margin-top: 50px; border-top: 1px solid #A56ACB; width: 300px; padding-top: 10px; text-align: center; }
        </style>
        
        <div class="titulo">ATESTADO MÉDICO</div>
        
        <div class="conteudo">
            <p>Atesto que o(a) Sr(a). <strong>' . $this->paciente . '</strong> esteve sob meus cuidados médicos.</p>
            <p>Diagnóstico: CID ' . $this->cid . '</p>
            <p>Recomenda-se repouso por ' . $this->dias . ' dias.</p>
            <p>Observações: ' . $this->observacoes . '</p>
            <p>Local e Data: ' . date('d/m/Y', strtotime($this->data)) . '</p>
            
            <div class="assinatura">
                <p>_________________________________________</p>
                <p>' . $this->medico . '</p>
                <p>CRM: </p>
            </div>
        </div>';
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pastaAtestados = dirname(__DIR__) . '/Atestado/pdfs/';
        if (!file_exists($pastaAtestados)) {
            mkdir($pastaAtestados, 0777, true);
        }
        
        $nomeArquivo = 'Atestado_' . $this->id . '.pdf';
        $caminhoCompleto = $pastaAtestados . $nomeArquivo;
        $pdf->Output($caminhoCompleto, 'F');
        
        return $nomeArquivo;
    }

    // Busca um atestado pelo ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM atestados WHERE id = :id";
        $params = [':id' => $id];
        
        try {
            $resultado = Database::executar($sql, $params);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar atestado: " . $e->getMessage());
            return false;
        }
    }

    // Novo método para listar todos os atestados
    public static function listarTodos() {
        $sql = "SELECT * FROM atestados ORDER BY data DESC";
        
        try {
            $resultado = Database::executar($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar atestados: " . $e->getMessage());
            return [];
        }
    }
}