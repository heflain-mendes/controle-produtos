<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/servico.php";

final class ServicoDAO
{
    private PDO $conn;
    private GenericDAO $decorator;

    public function __construct()
    {
        $c = new Conexao();

        $this->conn = $c->getConexao();
        $this->decorator = new GenericDAO($this->conn, "servicos");
    }

    public function insert(Servico $servico)
    {
        return $this->decorator->insert([
            "nome" => $servico->nome,
            "valor" => $servico->valor,
            "cidade" => $servico->cidade,
            "descricao" => $servico->descricao,
            "id_tipo" => $servico->idTipo,
            "id_prestador" => $servico->idPrestador
        ]);
    }

    public function getById($id): Servico
    {
        $servico = $this->decorator->find(["id" => $id, "esta_deletado" => false])[0];
        return ServicoDAO::assocToServico($servico);
    }

    public function getByIdUsuario($idUsuario): array
    {
        $servicosAssoc = $this->decorator->find(["id_prestador" => $idUsuario, "esta_deletado" => false]);
        $servicosObj = ServicoDAO::assocsToServicos($servicosAssoc);

        return $servicosObj;
    }

    public function update(Servico $servico)
    {
        $this->decorator->update([
            "id" => $servico->id
        ], [
            "nome" => $servico->nome,
            "valor" => $servico->valor,
            "cidade" => $servico->cidade,
            "descricao" => $servico->descricao,
            "id_tipo" => $servico->idTipo
        ]);
    }

    public function delete(int $id)
    {
        $this->decorator->update([
            "id" => $id
        ], [
            "esta_deletado" => 1
        ],);
    }

    public function getAll(): array
    {
        $sql = $this->conn->query("
        SELECT 
            s.id as id,
            s.id_prestador as id_prestador,
            s.nome as nome,
            s.valor as valor,
            s.cidade as cidade,
            s.descricao as descricao,
            s.id_tipo as id_tipo
        FROM servicos s
        INNER JOIN datas_disponiveis d 
        ON s.id = d.id_servico
        WHERE 
            s.esta_deletado = 0 AND
            d.disponivel = 1 AND
            d.data > CURRENT_DATE
        GROUP BY d.id_servico");

        $servicosAssoc = $sql->fetchAll(PDO::FETCH_ASSOC);
        $servicosObj = ServicoDAO::assocsToServicos($servicosAssoc);

        return $servicosObj;
    }

    private static function assocToServico($data): Servico | null
    {
        if (!isset($data)) return null;

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

    private static function assocsToServicos($data): array | null
    {
        if (!isset($data)) return null;

        $r = [];

        foreach ($data as $item) {
            $r[] = ServicoDAO::assocToServico($item);
        }

        return $r ?? [];
    }
}

?>
