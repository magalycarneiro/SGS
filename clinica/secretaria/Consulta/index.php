<?php 
require_once(__DIR__ . "/../Classes/Consulta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idconsulta = isset($_POST['idconsulta']) ? $_POST['idconsulta'] : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $idpaciente = isset($_POST['idpaciente']) ? $_POST['idpaciente'] : "";
    $idmedico = isset($_POST['idmedico']) ? $_POST['idmedico'] : "";
    $data_hora = isset($_POST['data_hora']) ? $_POST['data_hora'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    
    $consulta = new Consulta($idconsulta, $status, $data_hora, $idmedico, $idpaciente);
    
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
        $formulario = str_replace('{idconsulta}', $consulta->getConsulta(), $formulario);
        $formulario = str_replace('{status}', $consulta->getStatus(), $formulario);
        $formulario = str_replace('{idpaciente}', $consulta->getPaciente(), $formulario);
        $formulario = str_replace('{idmedico}', $consulta->getMedico(), $formulario);
        $formulario = str_replace('{data_hora}', $consulta->getDataHora(), $formulario);  
    } else {
        $formulario = str_replace('{idconsulta}', 0, $formulario);
        $formulario = str_replace('{status}', '',$formulario);
        $formulario = str_replace('{idpaciente}', '', $formulario);
        $formulario = str_replace('{idmedico}', '', $formulario);
        $formulario = str_replace('{data_hora}', '', $formulario);
    }
    
    print($formulario); 
    include_once('lista_consulta.php');
} 
?>
