<?php

require_once 'config/Conexao.php';
require_once 'model/Cliente.php';

class ClienteDAO {

    private $tabela = 'clientes';

    public function salvar(Cliente $c) {
        $dados = [
            'nome'     => $c->getNome(),
            'cpf'      => $c->getCpf(),
            'telefone' => $c->getTelefone(),
            'email'    => $c->getEmail()
        ];
        return Conexao::requisicao('POST', $this->tabela, $dados) !== null;
    }

    public function listar() {
        $resultado = Conexao::requisicao('GET', $this->tabela, null, 'order=id.desc');
        $clientes = [];

        if ($resultado) {
            foreach ($resultado as $row) {
                $c = new Cliente($row['nome'], $row['cpf'], $row['telefone'], $row['email']);
                $c->setId($row['id']);
                $clientes[] = $c;
            }
        }

        return $clientes;
    }

    public function buscarPorId($id) {
        $resultado = Conexao::requisicao('GET', $this->tabela, null, 'id=eq.' . $id);

        if ($resultado && count($resultado) > 0) {
            $row = $resultado[0];
            $c = new Cliente($row['nome'], $row['cpf'], $row['telefone'], $row['email']);
            $c->setId($row['id']);
            return $c;
        }

        return null;
    }

    public function atualizar(Cliente $c) {
        $dados = [
            'nome'     => $c->getNome(),
            'cpf'      => $c->getCpf(),
            'telefone' => $c->getTelefone(),
            'email'    => $c->getEmail()
        ];
        return Conexao::requisicao('PATCH', $this->tabela, $dados, 'id=eq.' . $c->getId()) !== null;
    }

    public function deletar($id) {
        return Conexao::requisicao('DELETE', $this->tabela, null, 'id=eq.' . $id) !== null;
    }
}
