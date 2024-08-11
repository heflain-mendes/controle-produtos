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
        $cliente = $this->decorator->find(["Email" => $email, "Senha" => $senha]);

        return ClienteDAO::assocToCliente($cliente);
    }

    private static function assocToCliente(array $data) : Cliente | null{
        if(!isset($data)) return null;

        $c = new Cliente();

        $c->codCli = $data["CodCli"];
        $c->nome = $data["Nome"];
        $c->endereco = $data["Endereco"];
        $c->telefone = $data["Telefone"];
        $c->CPF = $data["CPF"];
        $c->setDtNascimento($data["DtNascimento"]);
        $c->email = $data["Email"];
        $c->senha = $data["Senha"];

        return $c;
    }
}