<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/servico.php";

final class ServicoDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "servicos");
    }

    private static function assocToServico($data) : Servico | null {
        if(!isset($data)) return null;

        $s = new Servico();

        $s->idServico = $data["id_servico"];
        $s->nome = $data["nome"];
        $s->valor = $data["valor"];
        $s->descricao = $data["descricao"];
        $s->idTipo = $data["id_tipo"];

        return $s;
    }
}
?>