<?php

require_once 'model/Cliente.php';
require_once 'dao/ClienteDAO.php';

class ClienteController {

    public function salvar($nome, $cpf, $telefone, $email) {
        $cliente = new Cliente($nome, $cpf, $telefone, $email);
        $dao = new ClienteDAO();
        return $dao->salvar($cliente);
    }

    public function listar() {
        $dao = new ClienteDAO();
        return $dao->listar();
    }

    public function buscarPorId($id) {
        $dao = new ClienteDAO();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $nome, $cpf, $telefone, $email) {
        $cliente = new Cliente($nome, $cpf, $telefone, $email);
        $cliente->setId($id);
        $dao = new ClienteDAO();
        return $dao->atualizar($cliente);
    }

    public function deletar($id) {
        $dao = new ClienteDAO();
        return $dao->deletar($id);
    }
}
