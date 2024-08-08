<?php
require_once "conexao.inc.php";

class ClienteDao{
    private PDO $con;

    public function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function Autenticar($email, $senha) {
        $sql = $this->con->prepare("select * from clientes where email = :email and senha = :senha");

        $email = strtolower($email);
        $senha = strtolower($senha);

        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        $cliente = null;

        if($sql->rowCount() == 1){
            $cliente = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $cliente;
    }
}