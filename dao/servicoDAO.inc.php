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

    public function insert(string $nome, float $valor, string $descricao, int $tipo ) {
        $this->decorator->insert([
            "nome" => $nome,
            "valor" => $valor,
            "descricao" => $descricao,
            "id_tipo" => $tipo
        ]);
    }

    public function deleteById(int $id) {
        $this->decorator->delete(["id_tipo" => $id]);
    }

    public function update(Servico $servico) {
        $this->decorator->update([
            "nome" => $servico->nome,
            "valor" => $servico->valor,
            "descricao" => $servico->descricao,
            "id_tipo" => $servico->tipo
        ],[
            "id_servico" => $servico->idServico
        ]);
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