<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/cliente.php";


class ClienteDao{
    private PDO $conn;
    private genericDAO $decorator;

    public function __construct()
    {
        $c = new conexao();
        $this->conn = $c->getconexao();

        $decorator = new GenericDAO($this->conn, "clientes", Cliente::class);

        $this->decorator = $decorator;
    }

    public function Autenticar($email, $senha) : Cliente | null {
        $cliente = $this->decorator->find(["email" => $email, "senha" => $senha]);

        return $cliente;
    }
}