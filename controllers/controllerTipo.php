<?php
require_once "../dao/tipoDAO.inc.php";

$opcao = 0;

if(isset($_REQUEST["opcao"]) && is_numeric($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

$tipoDAO = new TipoDAO();

switch ($opcao) {
    case 1:
        $tipos = $tipoDAO->getAll();

        session_start();
        $_SESSION["tipos"] = $tipos;

        header("Location: ../views/formServico.php");
        break;
    default:
        # code...
        break;
}
?>