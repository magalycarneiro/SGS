<?php 
require_once(__DIR__ . '/../../Classe/Database.class.php');


class Consulta {
    public ?int $idconsulta;   
    public string $status;
    public string $data_hora;
    public string $idmedico;
    public string $idpaciente;

    public function __construct(?int $idconsulta, string $status, string $data_hora, string $idmedico, string $idpaciente) {
        $this->idconsulta = $idconsulta;
        $this->status     = $status;
        $this->data_hora  = $data_hora;
        $this->idmedico   = $idmedico;
        $this->idpaciente = $idpaciente;
    }

    public function setStatus($status){
        if ($status == "")
            throw new Exception("Erro, o status da consulta deve ser informado!");
        else
            $this->status = $status;
    }

    public function setConsulta($idconsulta){
        if ($idconsulta < 0)
            throw new Exception("Erro, a idconsulta deve ser maior que 0!");
        else
            $this->idconsulta = $idconsulta;
    }

    public function setDataHora($data_hora){
        if ($data_hora == "")
                throw new Exception("Erro, a data e hora devem ser informadas!");
        else
                $this->data_hora = $data_hora;
    }

    public function setMedico($idmedico){
        if ($idmedico == "")
            throw new Exception("Erro, o médico deve ser informado!");
        else
            $this->medico = $idmedico;
    }

    public function setPaciente($idpaciente){
        if ($idpaciente == "")
            throw new Exception("Erro, o paciente deve ser informado!");
        else
            $this->paciente = $idpaciente;
    }

    public function getConsulta(): int{
        return $this->idconsulta;
    }
    public function getStatus(): String{
        return $this->status;
    }
    public function getDataHora(): String{
        return $this->data_hora;
    }
    public function getMedico(): String{
        return $this->idmedico;
    }
    public function getPaciente(): String{
        return $this->idpaciente;
    }
    
    public function __toString():String{  
        $str = " - Consulta: $this->idconsulta,
                 - Status: $this->status,
                 - Data_hora: $this->data_hora,
                 - Medico: $this->idmedico,
                 - Paciente: $this->idpaciente";        
        return $str;
    }

    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO consulta 
                    (status,data_hora, idmedico, idpaciente)
                    VALUES(:status, :data_hora, :idmedico, :idpaciente)";
        
        $parametros = array(':status'=>$this->getStatus(),
                            ':data_hora'=>$this->getDataHora(),
                            ':idmedico'=>$this->getMedico(),
                            ':idpaciente'=>$this->getPaciente());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM consulta";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE idconsulta = :info ORDER BY idconsulta"; break; 
            case 2: $sql .= " WHERE idpaciente like :info ORDER BY idpaciente"; $info = '%'.$info.'%'; break;
            case 3: $sql .= " WHERE idmedico like :info ORDER BY idmedico"; $info = '%'.$info.'%'; break;
            case 4: 
                if (stripos($info, 'confirmada') !== false) {
                    $info = '1';
                } elseif (stripos($info, 'não confirmada') !== false || stripos($info, 'nao confirmada') !== false) {
                    $info = '2';}
                $sql .= " WHERE status = :info ORDER BY status"; 
                break;
            
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $consultas = [];
        while ($registro = $comando->fetch()){
            $consulta = new Consulta($registro['idconsulta'],$registro['status'],$registro['data_hora'],$registro['idmedico'],$registro['idpaciente']);
            array_push($consultas,$consulta);
        }
        return $consultas;
    }

    public function alterar():Bool{       
       $sql = "UPDATE consulta
                  SET status = :status, 
                      data_hora = :data_hora,
                      idmedico = :idmedico,
                      idpaciente = :idpaciente
                WHERE idconsulta = :idconsulta";
         $parametros = array(':idconsulta'=>$this->getConsulta(),
                        ':status'=>$this->getStatus(),
                        ':data_hora'=>$this->getDataHora(),
                        ':idmedico'=>$this->getMedico(),
                        ':idpaciente'=>$this->getPaciente());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM consulta
                      WHERE idconsulta = :idconsulta";
        $parametros = array(':idconsulta'=>$this->getConsulta());
        return Database::executar($sql, $parametros) == true;
     }
}

?>