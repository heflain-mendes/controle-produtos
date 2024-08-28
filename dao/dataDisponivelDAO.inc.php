<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/dataDisponivel.php";
require_once "../utils/funcoesUteis.php";

final class DataDisponivelDAO
{
    private PDO $conn;
    private GenericDAO $decorator;
    private string $nomeDatabase = "datas_disponiveis";

    public function __construct() {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, $this->nomeDatabase);
    }

    public function insert(DataDisponivel $dtDisponivel) {
        $this->decorator->insert([
            "id_servico" => $dtDisponivel->idServico, 
            "data" => $dtDisponivel->data, 
            "disponivel" => $dtDisponivel->disponivel
        ]);
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

        $d = new DataDisponivel($data["id_servico"], $data["data"], $data["disponivel"]);
        $d->id = $data["id"];
        
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