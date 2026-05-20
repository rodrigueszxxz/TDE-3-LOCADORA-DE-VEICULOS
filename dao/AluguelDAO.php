<?php

require_once 'config/Conexao.php';
require_once 'model/Aluguel.php';

class AluguelDAO {

    private $tabela = 'alugueis';

    public function salvar(Aluguel $a) {
        $dados = [
            'cliente_id'  => (int) $a->getClienteId(),
            'veiculo_id'  => (int) $a->getVeiculoId(),
            'data_inicio' => $a->getDataInicio(),
            'data_fim'    => $a->getDataFim(),
        ];
        return Conexao::requisicao('POST', $this->tabela, $dados) !== null;
    }

    public function listar() {
        $filtro    = 'select=*,clientes(nome),veiculos(modelo)&order=id.desc';
        $resultado = Conexao::requisicao('GET', $this->tabela, null, $filtro);

        $alugueis = [];

        if ($resultado) {
            foreach ($resultado as $row) {
                $a = new Aluguel($row['cliente_id'], $row['veiculo_id'], $row['data_inicio'], $row['data_fim']);
                $a->setId($row['id']);
                $a->setNomeCliente($row['clientes']['nome'] ?? '');
                $a->setModeloVeiculo($row['veiculos']['modelo'] ?? '');
                $alugueis[] = $a;
            }
        }

        return $alugueis;
    }

    public function buscarPorId($id) {
        $resultado = Conexao::requisicao('GET', $this->tabela, null, 'id=eq.' . $id);

        if ($resultado && count($resultado) > 0) {
            $row = $resultado[0];
            $a = new Aluguel($row['cliente_id'], $row['veiculo_id'], $row['data_inicio'], $row['data_fim']);
            $a->setId($row['id']);
            return $a;
        }

        return null;
    }

    public function atualizar(Aluguel $a) {
        $dados = [
            'cliente_id'  => (int) $a->getClienteId(),
            'veiculo_id'  => (int) $a->getVeiculoId(),
            'data_inicio' => $a->getDataInicio(),
            'data_fim'    => $a->getDataFim()
        ];
        return Conexao::requisicao('PATCH', $this->tabela, $dados, 'id=eq.' . $a->getId()) !== null;
    }

    public function deletar($id) {
        return Conexao::requisicao('DELETE', $this->tabela, null, 'id=eq.' . $id) !== null;
    }
}
