<?php

require_once 'model/Veiculo.php';
require_once 'dao/VeiculoDAO.php';

class VeiculoController {

    public function salvar($modelo, $marca, $placa, $ano, $diaria) {
        $veiculo = new Veiculo($modelo, $marca, $placa, $ano, $diaria);
        $dao = new VeiculoDAO();
        return $dao->salvar($veiculo);
    }

    public function listar() {
        $dao = new VeiculoDAO();
        return $dao->listar();
    }

    public function buscarPorId($id) {
        $dao = new VeiculoDAO();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $modelo, $marca, $placa, $ano, $diaria) {
        $veiculo = new Veiculo($modelo, $marca, $placa, $ano, $diaria);
        $veiculo->setId($id);
        $dao = new VeiculoDAO();
        return $dao->atualizar($veiculo);
    }

    public function deletar($id) {
        $dao = new VeiculoDAO();
        return $dao->deletar($id);
    }
}
