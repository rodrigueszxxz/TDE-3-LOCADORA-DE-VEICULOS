<?php

require_once 'controller/VeiculoController.php';

$controller = new VeiculoController();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id     = $_POST['id']     ?? '';
    $modelo = trim($_POST['modelo'] ?? '');
    $marca  = trim($_POST['marca']  ?? '');
    $placa  = trim($_POST['placa']  ?? '');
    $ano    = trim($_POST['ano']    ?? '');
    $diaria = trim($_POST['diaria'] ?? '');

    if (($_POST['acao'] ?? '') === 'salvar') {
        if ($id) {
            $ok = $controller->atualizar($id, $modelo, $marca, $placa, $ano, $diaria);
            $mensagem = $ok ? '✅ Veículo atualizado com sucesso!' : '❌ Erro ao atualizar veículo. Verifique a conexão com o banco.';
        } else {
            $ok = $controller->salvar($modelo, $marca, $placa, $ano, $diaria);
            $mensagem = $ok ? '✅ Veículo cadastrado com sucesso!' : '❌ Erro ao cadastrar veículo. Verifique a conexão com o banco.';
        }
    }
}

if (isset($_GET['editar'])) {
    $veiculoEdit = $controller->buscarPorId((int)$_GET['editar']);
}

if (isset($_GET['deletar'])) {
    $ok = $controller->deletar((int)$_GET['deletar']);
    $mensagem = $ok ? '🗑️ Veículo excluído com sucesso!' : '❌ Erro ao excluir veículo.';
}

$veiculos = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Veículos - Locadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <span class="nav-titulo">🚗 Locadora de Veículos</span>
    <a href="index.php">Início</a>
    <a href="veiculos.php" class="ativo">Veículos</a>
    <a href="clientes.php">Clientes</a>
    <a href="alugueis.php">Aluguéis</a>
</nav>

<div class="pagina">
    <h1>🚘 Gerenciar Veículos</h1>

    <?php if ($mensagem): ?>
        <div class="mensagem"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <div class="container">

        <div class="col-form">
            <h2><?php echo isset($veiculoEdit) ? '✏️ Editar Veículo' : '➕ Novo Veículo'; ?></h2>
            <?php require_once 'view/veiculo_form.php'; ?>
        </div>

        <div class="col-lista">
            <h2>Lista de Veículos</h2>

            <?php if (count($veiculos) === 0): ?>
                <p class="sem-dados">Nenhum veículo cadastrado ainda.</p>

            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Placa</th>
                            <th>Ano</th>
                            <th>Diária</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($veiculos as $v): ?>
                            <tr>
                                <td><?php echo (int)$v->getId(); ?></td>
                                <td><?php echo htmlspecialchars($v->getModelo()); ?></td>
                                <td><?php echo htmlspecialchars($v->getMarca()); ?></td>
                                <td><?php echo htmlspecialchars($v->getPlaca()); ?></td>
                                <td><?php echo (int)$v->getAno(); ?></td>
                                <td>R$ <?php echo number_format($v->getDiaria(), 2, ',', '.'); ?></td>
                                <td>
                                    <a class="btn-editar" href="?editar=<?php echo (int)$v->getId(); ?>">Editar</a>
                                    <a class="btn-excluir"
                                       href="?deletar=<?php echo (int)$v->getId(); ?>"
                                       onclick="return confirm('Tem certeza que deseja excluir este veículo?');">
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
