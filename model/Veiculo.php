<?php

class Veiculo {

    private $id;
    private $modelo;   
    private $marca;    
    private $placa;    
    private $ano;      
    private $diaria;   

    public function __construct($modelo = '', $marca = '', $placa = '', $ano = '', $diaria = '') {
        $this->modelo = $modelo;
        $this->marca  = $marca;
        $this->placa  = $placa;
        $this->ano    = $ano;
        $this->diaria = $diaria;
    }

    public function getId()     { return $this->id; }
    public function getModelo() { return $this->modelo; }
    public function getMarca()  { return $this->marca; }
    public function getPlaca()  { return $this->placa; }
    public function getAno()    { return $this->ano; }
    public function getDiaria() { return $this->diaria; }

    public function setId($id)         { $this->id = $id; }
    public function setModelo($modelo) { $this->modelo = $modelo; }
    public function setMarca($marca)   { $this->marca = $marca; }
    public function setPlaca($placa)   { $this->placa = $placa; }
    public function setAno($ano)       { $this->ano = $ano; }
    public function setDiaria($diaria) { $this->diaria = $diaria; }
}
