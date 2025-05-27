<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');


class Atividade{
    private int $id;
    private $status;
    private $data_hora;

    // construtor da classe
    public function __construct($id,$status,$data_hora){
        $this->id = $id;
        $this->status = $status;
        $this->data_hora = $data_hora;
    }

    // função / interface para aterar e ler
    public function setStatus($status){
        if ($status == "")
            throw new Exception("Erro, o status da consulta deve ser informado!");
        else
            $this->status = $status;
    }
    // cada atributo tem um método set para alterar seu valor
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro, a ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setDataHora($peso){
            if ($data_hora == "")
                throw new Exception("Erro, a data e hora devem ser informadas!");
            else
                $this->data_hora = $data_hora;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getStatus(): String{
        return $this->status;
    }
    public function getDataHora(): String{
        return $this->data_hora;
    }

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Consulta: $this->id - $this->status
                 - Data_hora: $this->peso";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO consulta 
                    (status,data_hora)
                    VALUES(:descricao, :peso, :anexo)";
        
        $parametros = array(':descricao'=>$this->getDescricao(),
                            ':peso'=>$this->getPeso(),
                            ':anexo'=>$this->getAnexo());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM atividade";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE descricao like :info ORDER BY descricao"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        //$resultado = $comando->fetchAll();
        $atividades = [];
        while ($registro = $comando->fetch()){
            $atividade = new Atividade($registro['id'],$registro['descricao'],$registro['peso'],$registro['anexo']);
            array_push($atividades,$atividade);
        }
        return $atividades;
    }

    public function alterar():Bool{       
       $sql = "UPDATE atividade
                  SET descricao = :descricao, 
                      peso = :peso,
                      anexo = :anexo
                WHERE id = :id";
         $parametros = array(':id'=>$this->getid(),
                        ':descricao'=>$this->getDescricao(),
                        ':peso'=>$this->getPeso(),
                        ':anexo'=>$this->getAnexo());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM atividade
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}

?>