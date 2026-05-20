<?php

require_once 'config/Conexao.php';
require_once 'model/Veiculo.php';

class VeiculoDAO {

    private $tabela = 'veiculos';

    public function salvar(Veiculo $v) {
        $dados = [
            'modelo' => $v->getModelo(),
            'marca'  => $v->getMarca(),
            'placa'  => $v->getPlaca(),
            'ano'    => $v->getAno(),
            'diaria' => $v->getDiaria()
        ];

        $resultado = Conexao::requisicao('POST', $this->tabela, $dados);
        return $resultado !== null;
    }

    public function listar() {
        $resultado = Conexao::requisicao('GET', $this->tabela, null, 'order=id.desc');

        $veiculos = [];

        if ($resultado) {
            foreach ($resultado as $row) {
                $v = new Veiculo($row['modelo'], $row['marca'], $row['placa'], $row['ano'], $row['diaria']);
                $v->setId($row['id']);
                $veiculos[] = $v;
            }
        }

        return $veiculos;
    }

    public function buscarPorId($id) {
        $resultado = Conexao::requisicao('GET', $this->tabela, null, 'id=eq.' . $id);

        if ($resultado && count($resultado) > 0) {
            $row = $resultado[0];
            $v = new Veiculo($row['modelo'], $row['marca'], $row['placa'], $row['ano'], $row['diaria']);
            $v->setId($row['id']);
            return $v;
        }

        return null;
    }

    public function atualizar(Veiculo $v) {
        $dados = [
            'modelo' => $v->getModelo(),
            'marca'  => $v->getMarca(),
            'placa'  => $v->getPlaca(),
            'ano'    => $v->getAno(),
            'diaria' => $v->getDiaria()
        ];

        $resultado = Conexao::requisicao('PATCH', $this->tabela, $dados, 'id=eq.' . $v->getId());
        return $resultado !== null;
    }

    public function deletar($id) {
        $resultado = Conexao::requisicao('DELETE', $this->tabela, null, 'id=eq.' . $id);
        return $resultado !== null;
    }
}
