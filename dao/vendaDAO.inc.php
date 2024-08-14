<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/venda.php";

final class TipoDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "vendas");
    }

    public function insert(int $codCliente, int $codProduto, float $valorTotal, int $qtdItem) {
        $this->decorator->insert([
            "id" => $codCliente,
            "id_produto" => $codProduto,
            "valor_total" => $valorTotal,
            "qtd_itens" => $qtdItem
        ]);
    }

    private static function assocToVenda($data) : Venda | null{
        if(!isset($data)) return null;

        $v = new Venda();

        $v->id = $data["id"];
        $v->idCliente = $data["id_cliente"];
        $v->idProduto = $data["id_produto"];
        $v->valorTotal = $data["valor_total"];
        $v->qtdItens = $data["qtd_itens"];

        return $v;
    }
}
?>