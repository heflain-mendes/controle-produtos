<?php
require_once "../dao/clienteDAO.inc.php";
$clienteDao = new ClienteDao();

$opc = (int)$_REQUEST["pOpcao"];

if($opc == 1){
    //recupero as informações do login
    $email = $_REQUEST["pEmail"];
    $senha = $_REQUEST["pSenha"];

    //passo o email e senha para ser autenticado pelo clienteDao
    $cliente = $clienteDao->Autenticar($email, $senha);

    //verifica as credenciais correponde a algum cliente
    if($cliente != null){
        session_start();
        $_SESSION["cliente"] = $cliente;
        header("Location: ../views/exibirProdutos.php");
    }else{
        header("Location: ../views/formLogin.php?erro=1");
    }
}