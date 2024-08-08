<?php
require_once "../utils/funcoesUteis.php";

final class DatasDisponiveis {
    private int $idDisponibilidade;
    private int $idServico;
    private int $data;
    private int $disponivel;

    public function __set($name, $value) : self
    {
        $this->$name = $value;
        return $this;
    }
    
    public function __get($name)
    {
        return $this->$name;
    }

    public function getData() : string {
        return parseTimestamp($this->data);
    }

    public function setData(string $value) : self {
        $this->data = strtotime($value);
        return $this;
    }
}
?>