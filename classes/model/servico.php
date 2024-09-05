<?php
require_once "dataDisponivel.php";
require_once "tipo.php";

final class Servico 
{
    private int $id;
    private Tipo $tipo;
    private array $datasDisponiveis;
    private bool $possuiServicoAFazer;
    private string $nomePrestador;

    
    public function __construct(
        private string $nome,
        private float $valor,
        private string $cidade,
        private string $descricao,
        private int $idTipo,
        private int $idPrestador
    ) {}

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function getData($idData){
        foreach($this->datasDisponiveis as $data){
            if($data->id == $idData){
                return $data;
            }
        }
        return null;
    }
}
?>