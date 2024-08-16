<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/usuario.php";


class UsuarioDAO{
    private PDO $conn;
    private genericDAO $decorator;

    public function __construct()
    {
        $c = new conexao();
        $this->conn = $c->getconexao();

        $decorator = new GenericDAO($this->conn, "usuarios");

        $this->decorator = $decorator;
    }

    public function Autenticar($email, $senha) : Usuario | null {
        $cliente = $this->decorator->find(["email" => $email, "senha" => $senha]);

        $retorno = null;

        if(isset($cliente)){
            $retorno = UsuarioDAO::assocToCliente($cliente[0]);
        }

        return $retorno;
    }

    private static function assocToCliente(array $data) : Usuario | null{
        if(!isset($data)) return null;

        $c = new Usuario(
            $data["nome"], 
            $data["endereco"], 
            $data["telefone"], 
            $data["cpf"], 
            strtotime($data["dt_nascimento"]), 
            $data["email"], 
            $data["senha"], 
            $data["tipo"]
        );

        $c->id = $data["id"];
        
        return $c;
    }
}