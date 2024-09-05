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
            "data" => parseISO($dtDisponivel->data), 
            "disponivel" => $dtDisponivel->disponivel
        ]);
    }

    public function findByIdServico(int $idServico) : array | null {
        $r = $this->decorator->find(["id_servico" => $idServico]);

        $rObj = DataDisponivelDAO::assocsToDatasDisponiveis($r);

        return $rObj ?? [];
    }

    public function findByIdServicoParaVenda(int $idServico) : array | null {
        $sql = $this->conn->prepare(
            "
                SELECT * 
                FROM $this->nomeDatabase
                WHERE id_servico = :id_servico AND disponivel = 1 AND data > CURRENT_DATE
            "
        );

        $sql->bindValue(":id_servico", $idServico);
        $sql->execute();

        $r = $sql->fetchAll(PDO::FETCH_ASSOC);

        $rObj = DataDisponivelDAO::assocsToDatasDisponiveis($r);

        return $rObj ?? []; 
    }

    public function update(array $datasDisponiveis, int $idServico) {
        $this->decorator->delete(["id_servico" => $idServico, "disponivel" => 1]);

        foreach($datasDisponiveis as $d) {
            $this->insert(new DataDisponivel($idServico, strtotime($d), true));
        }
    }

    private static function assocToDataDisponivel($data) : DataDisponivel | null{
        if(!isset($data)) return null;

        $d = new DataDisponivel(
            $data["id_servico"], 
            strtotime($data["data"]), 
            $data["disponivel"], 
            $data["id_venda"] ?? 0
        );
        
        $d->id = $data["id"];
        
        return $d;
    }

    private static function assocsToDatasDisponiveis($data) : array | null{
        if(!isset($data)) return null;

        $r = [];
        foreach($data as $item){
            $r[] = DataDisponivelDAO::assocToDataDisponivel($item);
        }

        return $r;
    }
}
?>