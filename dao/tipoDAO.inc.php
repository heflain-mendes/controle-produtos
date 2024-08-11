<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/tipo.php";

final class TipoDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "tipo");
    }

    private static function assocToTipo($data) : Tipo | null {
        if(!isset($data)) return null;

        $t = new Tipo;

        $t->idTipo = $data["id_tipo"];
        $t->nome = $data["nome"];
        $t->valor = $data["valor"];

        return $t;
    }
}



?>