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
            "Cod_cliente" => $codCliente,
            "Cod_produto" => $codProduto,
            "Valor_total" => $valorTotal,
            "Quantidade_itens" => $qtdItem
        ]);
    }

    private static function assocToVenda($data) : Venda | null{
        if(!isset($data)) return null;

        $v = new Venda();

        $v->codVenda = $data["Cod_venda"];
        $v->codCliente = $data["Cod_cliente"];
        $v->codProduto = $data["Cod_produto"];
        $v->valorTotal = $data["Valor_total"];
        $v->qtdItens = $data["Quantidade_itens"];

        return $v;
    }
}
?>