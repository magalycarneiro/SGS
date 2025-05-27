<?php
require_once(__DIR__ . "/../Classes/Prontuario.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $idPRONTUARIO = $_POST['idPRONTUARIO'] ?? 0;
        $prescricao = $_POST['prescricao'] ?? "";
        $observacoes = $_POST['observacoes'] ?? "";
        $diagnostico = $_POST['diagnostico'] ?? "";
        $acao = $_POST['acao'] ?? "";

        $prontuario = new Prontuario($idPRONTUARIO, $prescricao, $observacoes, $diagnostico);
        $resultado = false;

        if ($acao == 'salvar') {
            $resultado = ($idPRONTUARIO > 0) ? $prontuario->alterar() : $prontuario->inserir();
        } elseif ($acao == 'excluir') {
            $resultado = $prontuario->excluir();
        }

        if ($resultado) {
            header("Location: index.php");
            exit();
        } else {
            $erro = $prontuario->getMensagemErro();
            include('erro.php'); // Crie um arquivo de template para erros
        }
    } catch (Exception $e) {
        $erro = $e->getMessage();
        include('erro.php');
    }
} else {
    try {
        $id = $_GET['id'] ?? 0;
        $formulario = file_get_contents('form_cad_prontuario.html');

        if ($id > 0) {
            $resultado = Prontuario::listar(1, $id);
            if (!empty($resultado)) {
                $prontuario = $resultado[0];
                $formulario = str_replace(
                    ['{idPRONTUARIO}', '{prescricao}', '{observacoes}', '{diagnostico}'],
                    [
                        $prontuario->getIdPRONTUARIO(),
                        htmlspecialchars($prontuario->getPrescricao()),
                        htmlspecialchars($prontuario->getObservacoes()),
                        htmlspecialchars($prontuario->getDiagnostico())
                    ],
                    $formulario
                );
            }
        } else {
            $formulario = str_replace(
                ['{idPRONTUARIO}', '{prescricao}', '{observacoes}', '{diagnostico}'],
                ['', '', '', ''],
                $formulario
            );
        }

        echo $formulario;
        include('lista_prontuario.php');
    } catch (Exception $e) {
        $erro = $e->getMessage();
        include('erro.php');
    }
}
?>