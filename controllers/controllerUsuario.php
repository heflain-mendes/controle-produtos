<?php
require_once "../dao/usuarioDAO.inc.php";
$opcao = (int)$_REQUEST["opcao"];

switch ($opcao) {
    case 1: //Login
        try {
            $usuarioDao = new UsuarioDao();
            //recupero as informações do login
            $email = $_REQUEST["email"];
            $senha = $_REQUEST["senha"];

            //passa o email e senha para ser autenticado pelo usuarioDao
            $usuario = $usuarioDao->autenticar($email, $senha);

            //verifica as credenciais correponde a algum usuario
            if ($usuario != null) {
                session_start();
                $_SESSION["usuario"] = $usuario;

                header("Location: ../views/exibirServicos.php");
            } else {
                header("Location: ../views/formUsuarioLogin.php?erro=1"); //usuário não encontrado
            }
        } catch (Exception $e) {
            header("Location: ../views/formUsuarioLogin.php?erro=2"); //ocorreu algum problema ao fazer o login
        }
        break;
    case 2: //Logout
        session_start();
        unset($_SESSION["usuario"]);
        header("Location: ../views/index.php");
        break;
    case 3: //insert
        try {
            $usuarioDao = new UsuarioDao();
            $tipo = 'C';

            if (isset($_REQUEST["tipo"])) {
                $tipo = 'U';
            }

            $usuario = new Usuario(
                $_REQUEST["nome"],
                $_REQUEST["endereco"],
                $_REQUEST["telefone"],
                $_REQUEST["cpf"],
                strtotime($_REQUEST["dt_nascimento"]),
                $_REQUEST["email"],
                $_REQUEST["senha"],
                $tipo
            );

            $usuarioDao->insert($usuario);

            header("Location: ../views/formUsuarioLogin.php?erro=0"); //sucesso
        } catch (Exception $e) {
            header("Location: ../views/formUsuario.php?erro=1"); //erro ao cadastra usuário
        }
        break;

    case 4: //get by id
        try {
            $usuarioDao = new UsuarioDao();
            session_start();
            $_SESSION["usuario"] = $usuarioDao->getById($_SESSION["usuario"]->id);

            header("Location: ../views/formUsuarioAtualizar.php");
        } catch (Exception $e) {
            header("Location: controllerUsuario.php?opcao=2");
        }
        break;
    case 5: //update
        try {
            $usuarioDao = new UsuarioDao();
            session_start();
            $tipo = 'C';

            if (isset($_REQUEST["tipo"])) {
                $tipo = 'U';
            }

            $usuario = new Usuario(
                $_REQUEST["nome"],
                $_REQUEST["endereco"],
                $_REQUEST["telefone"],
                $_REQUEST["cpf"],
                strtotime($_REQUEST["dt_nascimento"]),
                $_REQUEST["email"],
                "",
                $tipo
            );
            $usuario->id = $_REQUEST["id"];

            $usuarioDao->updateSemSenha($usuario);

            $_SESSION["usuario"] = $usuarioDao->autenticar($_REQUEST["email"],  $_SESSION["usuario"]->senha);

            header("Location: ../views/formUsuarioAtualizar.php?erro=0"); //sucesso
        } catch (Exception $e) {
            header("Location: ../views/formUsuarioAtualizar.php?erro=1"); //falha ao atualizar usuário
        }
        break;
    case 6: //update senha
        try {
            $usuarioDao = new UsuarioDao();
            $senha = $_REQUEST["senha"];
            session_start();
            $id = $_SESSION["usuario"]->id;

            $usuarioDao->updateSenha($id, $senha);

            $_SESSION["usuario"] = $usuarioDao->autenticar($_SESSION["usuario"]->email,  $senha);
            header("Location: ../views/formUsuarioAtualizarSenha.php?erro=0"); //sucesso
        } catch (Exception $e) {
            header("Location: ../views/formUsuarioAtualizarSenha.php?erro=1"); //falha ao atualizar a senha
        }
        break;
    case 7:
        try{
            $usuarioDao = new UsuarioDao();
            $id = $_REQUEST["id"];

            $usuarioDao->delelte($id);

            header("Location: controllerUsuario.php?opcao=2"); //logout
        }catch(Exception $e){
            header("Location: ../views/formUsuarioAtualizar.php?erro=2"); //falha ao excluir usuário
        }
        break;
}
