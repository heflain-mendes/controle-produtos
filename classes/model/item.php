<?php
require_once "servico.php";
require_once "dataDisponivel.php";

final class item
{
    private array $datas;
    public function __construct(
        private Servico $servico
    ) {}

    public function getServico(): Servico
    {
        return $this->servico;
    }

    public function getData(int $id): DataDisponivel
    {
        foreach ($this->datas as $data) {
            if ($data->id == $id) {
                return $data;
            }
        }

        return null;
    }

    public function getDatas(): array
    {
        return $this->datas ?? [];
    }

    public function addData(DataDisponivel $data)
    {
       $this->datas[] = $data;
    }

    public function removeData(int $id)
    {
        $this->datas = array_filter($this->datas, function($data) use ($id){
            return $data->id != $id;
        });
    }
}
