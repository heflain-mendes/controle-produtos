<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/dataDisponivel.php";

final class DatasDisponíveisDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "datasDispoviveis");
    }

    
    private static function assocToDataDisponivel($data) : DataDisponivel | null{
        if(!isset($data)) return null;

        $d = new DataDisponivel();

        $d->idServico = $data["id_servico"];
        $d->id_disponibilidade = $data["id_disponibilidade"];
        $d->setData($data["data"]);
        $d->disponivel = $data["diponivel"];

        return $d;
    }
}
?>