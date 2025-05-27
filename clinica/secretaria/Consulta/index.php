<?php
require_once(__DIR__ . "/../Classes/Consulta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idconsulta = isset($_POST['idconsulta']) ? $_POST['idconsulta'] : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $paciente = isset($_POST['paciente']) ? $_POST['paciente'] : "";
    $medico = isset($_POST['medico']) ? $_POST['medico'] : "";
    $data_hora = isset($_POST['data_hora']) ? $_POST['data_hora'] : "";
    $clinica = isset($_POST['clinica']) ? $_POST['clinica'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    
    $consulta = new Consulta($idconsulta, $status, $paciente, $medico, $data_hora, $clinica);
    
    if ($acao == 'salvar') {
        if ($idconsulta > 0) {
            $resultado = $consulta->alterar();
        } else {
            $resultado = $consulta->inserir();
        }
    } elseif ($acao == 'excluir') {
        $resultado = $consulta->excluir();
    }

    if ($resultado) {
        header("Location: index.php");
    } else {
        echo "Erro ao processar agendamento: ". $consulta;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $formulario = file_get_contents('form_cad_consulta.html');

    $idconsulta = isset($_GET['idconsulta']) ? $_GET['idconsulta'] : 0;
    $resultado = Consulta::listar(1, $idconsulta);
    
    if ($resultado) {
        $consulta = $resultado[0];
        $formulario = str_replace('{idconsulta}', $consulta->getIdconsulta(), $formulario);
        $formulario = str_replace('{status}', $status->getStatus(), $formulario);
        $formulario = str_replace('{paciente}', $consulta->getPaciente(), $formulario);
        $formulario = str_replace('{medico}', $consulta->getMedico(), $formulario);
        $formulario = str_replace('{data_hora}', $consulta->getDataHora(), $formulario);  
        $formulario = str_replace('{clinica}', $consulta->getClinica(), $formulario);
    } else {
        $formulario = str_replace('{idconsulta}', 0, $formulario);
        $formulario = str_replace('{status}', '',$formulario);
        $formulario = str_replace('{paciente}', '', $formulario);
        $formulario = str_replace('{medico}', '', $formulario);
        $formulario = str_replace('{data_hora}', '', $formulario);
        $formulario = str_replace('{clinica}', '', $formulario);
    }
    
    print($formulario); 
    include_once('lista_consulta.php');
}
?>