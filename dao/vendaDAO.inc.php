<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/venda.php";

final class VendaDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "vendas");
    }

    public function insert(Venda $venda): int {
        $this->decorator->insert([
            "id_contratante" => $venda->idContratante,
            "valor" => $venda->valor,
            "forma_pagamento" => $venda->formaPagamento
        ]);

        return $this->conn->lastInsertId();
    }

    private static function assocToVenda($data) : Venda | null{
        if(!isset($data)) return null;

        $v = new Venda(
            $data["id_contratante"], 
            $data["valor"], 
            $data["forma_pagamento"]
        );        
        $v->id = $data["id"];

        return $v;
    }
}
?>