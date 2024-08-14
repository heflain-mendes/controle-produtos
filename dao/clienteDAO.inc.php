<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/cliente.php";


class ClienteDAO{
    private PDO $conn;
    private genericDAO $decorator;

    public function __construct()
    {
        $c = new conexao();
        $this->conn = $c->getconexao();

        $decorator = new GenericDAO($this->conn, "clientes");

        $this->decorator = $decorator;
    }

    public function Autenticar($email, $senha) : Cliente | null {
        $cliente = $this->decorator->find(["email" => $email, "senha" => $senha]);

        $retorno = null;

        if(isset($cliente)){
            $retorno = ClienteDAO::assocToCliente($cliente[0]);
        }

        return $retorno;
    }

    private static function assocToCliente(array $data) : Cliente | null{
        if(!isset($data)) return null;

        $c = new Cliente();

        $c->id = $data["id"];
        $c->nome = $data["nome"];
        $c->endereco = $data["endereco"];
        $c->telefone = $data["telefone"];
        $c->cpf = $data["CPF"];
        $c->setDtNascimento($data["dt_nascimento"]);
        $c->email = $data["email"];
        $c->senha = $data["senha"];

        return $c;
    }
}