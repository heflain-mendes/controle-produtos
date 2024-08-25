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

    public function insert(Venda $venda) {
        $this->decorator->insert([
            "id_usuario" => $venda->idUsuario,
            "id_produto" => $venda->idServico,
            "valor_total" => $venda->valorTotal,
            "qtd_itens" => $venda->qtdItens
        ]);
    }

    private static function assocToVenda($data) : Venda | null{
        if(!isset($data)) return null;

        $v = new Venda(
            $data["id_usuario"], 
            $data["id_servico"], 
            $data["valor_total"], 
            $data["qtd_itens"]
        );        
        $v->id = $data["id"];

        return $v;
    }
}
?>