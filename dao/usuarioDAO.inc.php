<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/usuario.php";
require_once "../utils/funcoesUteis.php";

class UsuarioDAO{
    private PDO $conn;
    private genericDAO $decorator;
    private string $nomeDatabase = "usuarios";

    public function __construct()
    {
        $c = new conexao();
        $this->conn = $c->getconexao();

        $decorator = new GenericDAO($this->conn, $this->nomeDatabase);

        $this->decorator = $decorator;
    }

    public function autenticar($email, $senha) : Usuario | null {
        $usuario = $this->decorator->find(["email" => $email, "senha" => $senha, "esta_deletado" => 0])[0];

        $retorno = null;

        if(isset($usuario)){
            $retorno = UsuarioDAO::assocToUsuario($usuario);
            $retorno->possuiServicosFuturosAPrestar = $this->possuiServicosFuturosAPrestar($usuario->id);
            $retorno->possuiServicosFuturosContratados = $this->possuiServicosFuturosContratados($usuario->id);
        }

        return $retorno;
    }

    public function insert(
        Usuario $usuario
    ) : int{
        $data = parseISO($usuario->dtNascimento);
        return $this->decorator->insert([
            "nome" => $usuario->nome,
            "endereco" => $usuario->endereco,
            "telefone" => $usuario->telefone,
            "cpf_cnpj" => $usuario->cpf_cnpj,
            "dt_nascimento" => $data,
            "email" => $usuario->email,
            "senha" => $usuario->senha,
            "tipo" => $usuario->tipo
        ]);
    }

    public function updateSemSenha(Usuario $usuario) {
        $data = parseISO($usuario->dtNascimento);
        $this->decorator->update(["id" => $usuario->id], [
            "nome" => $usuario->nome,
            "endereco" => $usuario->endereco,
            "telefone" => $usuario->telefone,
            "cpf_cnpj" => $usuario->cpf_cnpj,
            "dt_nascimento" => $data,
            "email" => $usuario->email,
            "tipo" => $usuario->tipo
        ]);
    }

    public function updateSenha(int $id, string $senha) {
        $this->decorator->update(["id" => $id], ["senha" => $senha]);
    }

    public function getById(int $id) : Usuario {
        $usuario = UsuarioDAO::assocToUsuario($this->decorator->find(["id" => $id, "esta_deletado" => 0])[0]);
        $usuario->possuiServicosFuturosAPrestar = $this->possuiServicosFuturosAPrestar($usuario->id);
        $usuario->possuiServicosFuturosContratados = $this->possuiServicosFuturosContratados($usuario->id);

        return $usuario;
    }

    public function delete(Usuario $usuario) {
        $this->decorator->update(["id" => $usuario->id], 
        ["esta_deletado" => 1, 
        "email" => null, 
        "cpf_cnpj" => null,
        "email_deletado" => $usuario->email,
        "cpf_cnpj_deletado" => $usuario->cpf_cnpj
    ]);
    }

    private static function assocToUsuario(array $data) : Usuario | null{
        if(!isset($data)) return null;

        $c = new Usuario(
            $data["nome"], 
            $data["endereco"], 
            $data["telefone"], 
            $data["cpf_cnpj"], 
            strtotime($data["dt_nascimento"]), 
            $data["email"], 
            $data["senha"],
            $data["tipo"]
        );

        $c->id = $data["id"];
        
        return $c;
    }

    private function possuiServicosFuturosAPrestar($idUsuario) : bool {
        $sql = $this->conn->prepare(
            "SELECT EXISTS(
                SELECT *
                FROM servicos as s
                JOIN datas_disponiveis as dd
                ON s.id = dd.id_servico
                WHERE s.id_prestador = :id_usuario
                    AND dd.data > CURRENT_DATE
                    AND dd.disponivel = 0
            ) as existe_registo"
        );

        $sql->bindValue(":id_usuario", $idUsuario);

        $sql->execute();

        $r = $sql->fetch(PDO::FETCH_ASSOC);

        return (bool)$r["existe_registo"];
    }

    private function possuiServicosFuturosContratados($idUsuario) : bool {
        $sql = $this->conn->prepare(
            "SELECT EXISTS(
                SELECT *
                FROM datas_disponiveis as dd
                JOIN vendas as v
                ON v.id_datas_disponiveis = dd.id
                WHERE v.id_contratante = :id_usuario
                    AND dd.data > CURRENT_DATE
                    AND dd.disponivel = 0
            ) as existe_registo"
        );

        $sql->bindValue(":id_usuario", $idUsuario);

        $sql->execute();

        $r = $sql->fetch(PDO::FETCH_ASSOC);

        return (bool)$r["existe_registo"];
    }
}