<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/dataDisponivel.php";

final class DataDisponivelDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "datasDispoviveis");
    }

    public function insert(int $idServico, string $data, bool $disponivel) {
        $this->decorator->insert(["id_servico" => $idServico, "data" => $data, "disponivel" => $disponivel]);
    }

    public function findByIdServico(int $idServico) : array | null {
        $r = $this->decorator->find(["id_servico" => $idServico]);

        return DataDisponivelDAO::assocsToDatasDisponiveis($r);
    }

    public function deleteByIdServico(int $idServico) {
        $this->decorator->delete(["id_servico" => $idServico]);
    }

    private static function assocToDataDisponivel($data) : DataDisponivel | null{
        if(!isset($data)) return null;

        $d = new DataDisponivel();

        $d->id = $data["id"];
        $d->idDisponibilidade = $data["id_disponibilidade"];
        $d->setData($data["data"]);
        $d->disponivel = $data["diponivel"];

        return $d;
    }

    private static function assocsToDatasDisponiveis($data) : array | null{
        if(!isset($data)) return null;

        $r = [];
        foreach($r as $item){
            $r[] = DataDisponivelDAO::assocToDataDisponivel($item);
        }

        return $r;
    }
}
?>