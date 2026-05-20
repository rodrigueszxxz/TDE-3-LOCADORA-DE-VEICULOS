<?php

require_once 'controller/AluguelController.php';
require_once 'controller/ClienteController.php';
require_once 'controller/VeiculoController.php';

$controller        = new AluguelController();
$clienteController = new ClienteController();
$veiculoController = new VeiculoController();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = $_POST['id']          ?? '';
    $cliente_id  = $_POST['cliente_id']  ?? '';
    $veiculo_id  = $_POST['veiculo_id']  ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim    = $_POST['data_fim']    ?? '';

    if (($_POST['acao'] ?? '') === 'salvar') {
        if ($id) {
            $ok = $controller->atualizar($id, $cliente_id, $veiculo_id, $data_inicio, $data_fim);
            $mensagem = $ok ? '✅ Aluguel atualizado com sucesso!' : '❌ Erro ao atualizar aluguel. Verifique a conexão com o banco.';
        } else {
            $ok = $controller->salvar($cliente_id, $veiculo_id, $data_inicio, $data_fim);
            $mensagem = $ok ? '✅ Aluguel registrado com sucesso!' : '❌ Erro ao registrar aluguel. Verifique a conexão com o banco.';
        }
    }
}

if (isset($_GET['editar'])) {
    $aluguelEdit = $controller->buscarPorId((int)$_GET['editar']);
}

if (isset($_GET['deletar'])) {
    $ok = $controller->deletar((int)$_GET['deletar']);
    $mensagem = $ok ? '🗑️ Aluguel excluído com sucesso!' : '❌ Erro ao excluir aluguel.';
}

$clientes = $clienteController->listar();
$veiculos = $veiculoController->listar();
$alugueis = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Aluguéis - Locadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <span class="nav-titulo">🚗 Locadora de Veículos</span>
    <a href="index.php">Início</a>
    <a href="veiculos.php">Veículos</a>
    <a href="clientes.php">Clientes</a>
    <a href="alugueis.php" class="ativo">Aluguéis</a>
</nav>

<div class="pagina">
    <h1>📋 Gerenciar Aluguéis</h1>

    <?php if ($mensagem): ?>
        <div class="mensagem"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <div class="container">

        <div class="col-form">
            <h2><?php echo isset($aluguelEdit) ? '✏️ Editar Aluguel' : '➕ Novo Aluguel'; ?></h2>
            <?php require_once 'view/aluguel_form.php'; ?>
        </div>

        <div class="col-lista">
            <h2>Lista de Aluguéis</h2>

            <?php if (count($alugueis) === 0): ?>
                <p class="sem-dados">Nenhum aluguel registrado ainda.</p>

            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Veículo</th>
                            <th>Início</th>
                            <th>Devolução</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alugueis as $a): ?>
                            <tr>
                                <td><?php echo (int)$a->getId(); ?></td>
                                <td><?php echo htmlspecialchars($a->getNomeCliente()); ?></td>
                                <td><?php echo htmlspecialchars($a->getModeloVeiculo()); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($a->getDataInicio())); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($a->getDataFim())); ?></td>
                                <td>
                                    <a class="btn-editar" href="?editar=<?php echo (int)$a->getId(); ?>">Editar</a>
                                    <a class="btn-excluir"
                                       href="?deletar=<?php echo (int)$a->getId(); ?>"
                                       onclick="return confirm('Tem certeza que deseja excluir este aluguel?');">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div>
</div>

</body>
</html>
