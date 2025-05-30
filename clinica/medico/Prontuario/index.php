<?php
require_once(__DIR__ . "/../Classes/Prontuario.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Coleta todos os campos do formulário
        $idPRONTUARIO = $_POST['idPRONTUARIO'] ?? 0;
        $nomepaciente = $_POST['nomepaciente'] ?? "";
        $prescricao = $_POST['prescricao'] ?? "";
        $observacoes = $_POST['observacoes'] ?? "";
        $diagnostico = $_POST['diagnostico'] ?? "";
        $atestado = $_POST['atestado'] ?? "";
        $encaminhamento = $_POST['encaminhamento'] ?? "";
        $antecedentes = $_POST['antecedentes'] ?? "";
        $solicitacaoexames = $_POST['solicitacaoexames'] ?? "";
        $exames = $_POST['exames'] ?? "";
        $acao = $_POST['acao'] ?? "";

        // Cria objeto com todos os parâmetros
        $prontuario = new Prontuario(
            $idPRONTUARIO,
            $nomepaciente,
            $prescricao,
            $observacoes,
            $diagnostico,
            $atestado,
            $encaminhamento,
            $antecedentes,
            $solicitacaoexames,
            $exames
        );

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
            include('erro.php');
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
                    [
                        '{idPRONTUARIO}', 
                        '{nomepaciente}',
                        '{prescricao}', 
                        '{observacoes}', 
                        '{diagnostico}',
                        '{atestado}',
                        '{encaminhamento}',
                        '{antecedentes}',
                        '{solicitacaoexames}',
                        '{exames}'
                    ],
                    [
                        $prontuario->getIdPRONTUARIO(),
                        htmlspecialchars($prontuario->getNomepaciente()),
                        htmlspecialchars($prontuario->getPrescricao()),
                        htmlspecialchars($prontuario->getObservacoes()),
                        htmlspecialchars($prontuario->getDiagnostico()),
                        htmlspecialchars($prontuario->getAtestado()),
                        htmlspecialchars($prontuario->getEncaminhamento()),
                        htmlspecialchars($prontuario->getAntecedentes()),
                        htmlspecialchars($prontuario->getSolicitacaoexames()),
                        htmlspecialchars($prontuario->getExames())
                    ],
                    $formulario
                );
            }
        } else {
            $formulario = str_replace(
                [
                    '{idPRONTUARIO}',
                    '{nomepaciente}',
                    '{prescricao}',
                    '{observacoes}',
                    '{diagnostico}',
                    '{atestado}',
                    '{encaminhamento}',
                    '{antecedentes}',
                    '{solicitacaoexames}',
                    '{exames}'
                ],
                ['', '', '', '', '', '', '', '', '', ''],
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