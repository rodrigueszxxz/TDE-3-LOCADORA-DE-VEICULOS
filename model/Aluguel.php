<?php

class Aluguel {

    private $id;
    private $cliente_id;    
    private $veiculo_id;    
    private $data_inicio;   
    private $data_fim;      

    private $nome_cliente;
    private $modelo_veiculo;

    public function __construct($cliente_id = '', $veiculo_id = '', $data_inicio = '', $data_fim = '') {
        $this->cliente_id  = $cliente_id;
        $this->veiculo_id  = $veiculo_id;
        $this->data_inicio = $data_inicio;
        $this->data_fim    = $data_fim;
    }

    public function getId()            { return $this->id; }
    public function getClienteId()     { return $this->cliente_id; }
    public function getVeiculoId()     { return $this->veiculo_id; }
    public function getDataInicio()    { return $this->data_inicio; }
    public function getDataFim()       { return $this->data_fim; }
    public function getNomeCliente()   { return $this->nome_cliente; }
    public function getModeloVeiculo() { return $this->modelo_veiculo; }

    public function setId($id)                       { $this->id = $id; }
    public function setClienteId($cliente_id)        { $this->cliente_id = $cliente_id; }
    public function setVeiculoId($veiculo_id)        { $this->veiculo_id = $veiculo_id; }
    public function setDataInicio($data_inicio)      { $this->data_inicio = $data_inicio; }
    public function setDataFim($data_fim)            { $this->data_fim = $data_fim; }
    public function setNomeCliente($nome_cliente)    { $this->nome_cliente = $nome_cliente; }
    public function setModeloVeiculo($modelo_veiculo){ $this->modelo_veiculo = $modelo_veiculo; }
}
