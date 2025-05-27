<?php
require_once(__DIR__ . "/../Classes/Consulta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $paciente = isset($_POST['paciente']) ? $_POST['paciente'] : "";
    $medico = isset($_POST['medico']) ? $_POST['medico'] : "";
    $data = isset($_POST['data']) ? $_POST['data'] : "";
    $clinica = isset($_POST['clinica']) ? $_POST['clinica'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    
    $consulta = new Consulta($id, $paciente, $medico, $data, $clinica);
    
    if ($acao == 'salvar') {
        if ($id > 0) {
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

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $resultado = Consulta::listar(1, $id);
    
    if ($resultado) {
        $consulta = $resultado[0];
        $formulario = str_replace('{id}', $consulta->getId(), $formulario);
        $formulario = str_replace('{paciente}', $consulta->getPaciente(), $formulario);
        $formulario = str_replace('{medico}', $consulta->getMedico(), $formulario);
        $formulario = str_replace('{data}', $consulta->getData(), $formulario);  
        $formulario = str_replace('{clinica}', $consulta->getClinica(), $formulario);
    } else {
        $formulario = str_replace('{id}', 0, $formulario);
        $formulario = str_replace('{paciente}', '', $formulario);
        $formulario = str_replace('{medico}', '', $formulario);
        $formulario = str_replace('{data}', '', $formulario);
        $formulario = str_replace('{clinica}', '', $formulario);
    }
    
    print($formulario); 
    include_once('lista_consulta.php');
}
?>