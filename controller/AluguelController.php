<?php

require_once 'model/Aluguel.php';
require_once 'dao/AluguelDAO.php';

class AluguelController {

    public function salvar($cliente_id, $veiculo_id, $data_inicio, $data_fim) {
        $aluguel = new Aluguel($cliente_id, $veiculo_id, $data_inicio, $data_fim);
        $dao = new AluguelDAO();
        return $dao->salvar($aluguel);
    }

    public function listar() {
        $dao = new AluguelDAO();
        return $dao->listar();
    }

    public function buscarPorId($id) {
        $dao = new AluguelDAO();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $cliente_id, $veiculo_id, $data_inicio, $data_fim) {
        $aluguel = new Aluguel($cliente_id, $veiculo_id, $data_inicio, $data_fim);
        $aluguel->setId($id);
        $dao = new AluguelDAO();
        return $dao->atualizar($aluguel);
    }

    public function deletar($id) {
        $dao = new AluguelDAO();
        return $dao->deletar($id);
    }
}
