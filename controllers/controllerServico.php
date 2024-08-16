<?php
require_once "../dao/servicoDAO.inc.php";
require_once "../dao/dataDisponivelDAO.inc.php";

$opcao = 0;

if(isset($_REQUEST["opcao"]) && is_numeric($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

$servicoDAO = new ServicoDAO();
$datasDAO = new DataDisponivelDAO();
switch ($opcao) {
    case 2:
        $idServico = $servicoDAO->insert(
            $_REQUEST["nome"],
            $_REQUEST["valor"],
            $_REQUEST["descricao"],
            $_REQUEST["tipo"]
        );

        foreach($_REQUEST["datas"] as $data) {
            $datasDAO->insert($idServico, $data, true);
        }

        header("Location: ../views/exibirServicos.php");
        break;
    default:
        # code...
        break;
}
?>