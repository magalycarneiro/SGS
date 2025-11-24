<?php 
require_once(__DIR__ . '/../../Classe/Database.class.php');


class Paciente {
    public ?int $idpaciente;   
    public string $nome;
    public string $cpf;
    public string $data_nascimento;
    public string $telefone;
    public string $email;
    public string $endereco;

    public function __construct(?int $idpaciente, string $nome, string $cpf, string $data_nascimento, string $telefone, string $email, string $endereco) {
        $this->idpaciente       = $idpaciente;
        $this->nome             = $nome;
        $this->cpf              = $cpf;
        $this->data_nascimento  = $data_nascimento;
        $this->telefone         = $telefone;
        $this->email            = $email;
        $this->endereco         = $endereco;
    }

    public function setPaciente($idpaciente){
        if ($idpaciente < 0)
            throw new Exception("Erro, o id do(a) paciente deve ser maior que 0!");
        else
            $this->idpaciente = $idpaciente;
    }

    public function setNome($nome){
        if ($nome == "")
            throw new Exception("Erro, o nome do(a) paciente deve ser informado!");
        else
            $this->nome = $nome;
    }

    public function setCPF($cpf){
        if ($cpf == "")
                throw new Exception("Erro, o CPF do(a) paciente deve ser informado!");
        else
                $this->cpf = $cpf;
    }

    public function setData_nascimento($data_nascimento){
        if ($data_nascimento == "")
            throw new Exception("Erro, a data de nascimento do(a) paciente deve ser informada!");
        else
            $this->data_nascimento = $data_nascimento;
    }
    
    public function setTelefone($telefone){
        if ($telefone == "")
            throw new Exception("Erro, o número para contato do(a) paciente deve ser informado!");
        else
            $this->telefone = $telefone;
    }

    public function setEmail($email){
        if ($email == "")
            throw new Exception("Erro, o e-mail do(a) paciente deve ser informado!");
        else
            $this->email = $email;
    }
    
    public function setEndereco($endereco){
        if ($endereco == "")
            throw new Exception("Erro, o endereço do(a) paciente deve ser informado!");
        else
            $this->endereco = $endereco;
    }

    public function getPaciente(): String{
        return $this->idpaciente;
    }
    public function getNome(): String{
        return $this->nome;
    }
    public function getCPF(): String{
        return $this->cpf;
    }
    public function getData_nascimento(): String{
        return $this->data_nascimento;
    }
    public function getTelefone(): String{
        return $this->telefone;
    }
    public function getEmail(): String{
        return $this->email;
    }
    public function getEndereco(): String{
        return $this->endereco;
    }
    
    public function __toString():String{  
        $str = " - Paciente: $this->idpaciente,
                 - Nome: $this->nome,
                 - CPF: $this->cpf,
                 - Data_nascimento: $this->data_nascimento,
                 - Telefone: $this->telefone,
                 - Email: $this->email,
                 - Endereco: $this->endereco";        
        return $str;
    }

    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO paciente 
                    (nome, cpf, data_nascimento, telefone, email, endereco)
                    VALUES(:nome, :cpf, :data_nascimento, :telefone, :email, :endereco)";
        
        $parametros = array(':nome'=>$this->getNome(),
                            ':cpf'=>$this->getCPF(),
                            ':data_nascimento'=>$this->getData_nascimento(),
                            ':telefone'=>$this->getTelefone(),
                            ':email'=>$this->getEmail(),
                            ':endereco'=>$this->getEndereco());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM paciente";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE idpaciente = :info ORDER BY idpaciente"; break; 
            case 2: $sql .= " WHERE nome like :info ORDER BY nome"; $info = '%'.$info.'%'; break;
            case 3: $sql .= " WHERE cpf like :info ORDER BY cpf"; $info = '%'.$info.'%'; break;
            case 4: $sql .= " WHERE telefone like :info ORDER BY telefone"; $info = '%'.$info.'%'; break; 
            case 5: $sql .= " WHERE email like :info ORDER BY email"; $info = '%'.$info.'%'; break;
            case 6: $sql .= " WHERE endereco like :info ORDER BY endereco"; $info = '%'.$info.'%'; break;
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $pacientes = [];
        while ($registro = $comando->fetch()){
            $paciente = new Paciente($registro['idpaciente'],$registro['nome'],$registro['cpf'],$registro['data_nascimento'],$registro['telefone'], $registro['email'], $registro['endereco']);
            array_push($pacientes,$paciente);
        }
        return $pacientes;
    }

    public function alterar():Bool{       
       $sql = "UPDATE paciente
                  SET nome = :nome, 
                      cpf = :cpf,
                      data_nascimento = :data_nascimento,
                      telefone = :telefone,
                      email = :email,
                      endereco = :endereco,
                WHERE idpaciente = :idpaciente";
         $parametros = array(':idpaciente'=>$this->getPaciente(),
                        ':nome'=>$this->getNome(),
                        ':cpf'=>$this->getCPF(),
                        ':data_nascimento'=>$this->getData_nascimento(),
                        ':telefone'=>$this->getTelefone(),
                        ':email'=>$this->getEmail(),
                        ':endereco'=>$this->getEndereco());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM paciente
                      WHERE idpaciente = :idpaciente";
        $parametros = array(':idpaciente'=>$this->getPaciente());
        return Database::executar($sql, $parametros) == true;
     }
}

?>