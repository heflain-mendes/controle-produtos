<?php
require_once "../dao/usuarioDAO.inc.php";
$usuarioDao = new UsuarioDao();

$opcao = (int)$_REQUEST["opcao"];

switch ($opcao) {
    case 1: //Login
        //recupero as informações do login
        $email = $_REQUEST["pEmail"];
        $senha = $_REQUEST["pSenha"];

        //passa o email e senha para ser autenticado pelo usuarioDao
        $usuario = $usuarioDao->Autenticar($email, $senha);

        //verifica as credenciais correponde a algum cliente
        if ($usuario != null) {
            session_start();
            $_SESSION["usuario"] = $usuario;

            header("Location: ../views/exibirProdutos.php");
        } else {
            header("Location: ../views/formLogin.php?erro=1");
        }
        break;
    case 2: //Logout
        session_start();
        unset($_SESSION["usuario"]);
        header("Location: ../views/index.php");
        break;
    default:
        # code...
        break;
}
