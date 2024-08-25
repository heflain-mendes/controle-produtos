<?php
require_once "conexao.inc.php";
require_once "genericDAO.inc.php";
require_once "../classes/model/usuario.php";
require_once "../utils/funcoesUteis.php";

class UsuarioDAO{
    private PDO $conn;
    private genericDAO $decorator;

    public function __construct()
    {
        $c = new conexao();
        $this->conn = $c->getconexao();

        $decorator = new GenericDAO($this->conn, "usuarios");

        $this->decorator = $decorator;
    }

    public function autenticar($email, $senha) : Usuario | null {
        $usuario = $this->decorator->find(["email" => $email, "senha" => $senha])[0];

        $retorno = null;

        if(isset($usuario)){
            $retorno = UsuarioDAO::assocToUsuario($usuario);
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
            "cpf" => $usuario->cpf,
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
            "cpf" => $usuario->cpf,
            "dt_nascimento" => $data,
            "email" => $usuario->email,
            "tipo" => $usuario->tipo
        ]);
    }

    public function updateSenha(int $id, string $senha) {
        $this->decorator->update(["id" => $id], ["senha" => $senha]);
    }

    public function getById(int $id) : Usuario {
        return UsuarioDAO::assocToUsuario($this->decorator->find(["id" => $id])[0]);
    }

    public function delelte(int $id) {
        $this->decorator->delete(["id" => $id]);
    }

    private static function assocToUsuario(array $data) : Usuario | null{
        if(!isset($data)) return null;

        $c = new Usuario(
            $data["nome"], 
            $data["endereco"], 
            $data["telefone"], 
            $data["cpf"], 
            strtotime($data["dt_nascimento"]), 
            $data["email"], 
            $data["senha"],
            $data["tipo"]
        );

        $c->id = $data["id"];
        
        return $c;
    }
}