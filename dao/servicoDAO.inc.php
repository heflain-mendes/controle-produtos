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

    public function insert(Servico $servico) {
        return $this->decorator->insert([
            "nome" => $servico->nome,
            "valor" => $servico->valor,
            "cidade" => $servico->cidade,
            "descricao" => $servico->descricao,
            "id_tipo" => $servico->idTipo,
            "id_prestador" => $servico->idPrestador
        ]);
    }

    public function getById($id) : Servico{
       $servico = $this->decorator->find($id)[0];
       return ServicoDAO::assocToServico($servico);
    }

    public function getAll(){
        $servicos = $this->decorator->find();

        return ServicoDAO::assocsToServicos($servicos);
    }

    public function deleteById(int $id) {
        $this->decorator->delete(["id" => $id]);
    }

    public function update(Servico $servico) {
        $this->decorator->update([
            "nome" => $servico->nome,
            "valor" => $servico->valor,
            "cidade" => $servico->cidade,
            "descricao" => $servico->descricao,
            "id_tipo" => $servico->idTtipo
        ],[
            "id_servico" => $servico->idServico
        ]);
    }

    private static function assocToServico($data) : Servico | null {
        if(!isset($data)) return null;

        $s = new Servico(
            $data["nome"], 
            $data["valor"], 
            $data["cidade"], 
            $data["descricao"], 
            $data["id_tipo"],
            $data["id_prestador"]
        );
        $s->id = $data["id"];
        
        return $s;
    }

    private static function assocsToServicos($data) : array | null{
        if(!isset($data)) return null;

        $r=[];

        foreach ($data as $item) {
            $r[] = ServicoDAO::assocToServico($item);
        }

        return $r;
    }
}
?>