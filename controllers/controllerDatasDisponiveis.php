<?php
require_once "../dao/dataDisponivelDAO.inc.php";
require_once "../classes/model/dataDisponivel.php";

$opcao = null;

if(isset($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

switch ($opcao) {
    case 1: //possui data de serviço contratados futuros?
        session_start();
        $idUsuario = $_SESSION["usuario"]->id;
        $datasDisponiveisDAO = new DataDisponivelDAO();
        
        $_SESSION["usuario"]->possuiServicoFuturos = $datasDisponivelDAO->doesServiceExistOnFutureDate($idUsuario);

        
        break;
    
    default:
        # code...
        break;
}

?>