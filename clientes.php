<?php

require_once 'controller/ClienteController.php';

$controller = new ClienteController();
$mensagem   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = $_POST['id']       ?? '';
    $nome     = trim($_POST['nome']     ?? '');
    $cpf      = trim($_POST['cpf']      ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email']    ?? '');

    if (($_POST['acao'] ?? '') === 'salvar') {
        if ($id) {
            $ok = $controller->atualizar($id, $nome, $cpf, $telefone, $email);
            $mensagem = $ok ? '✅ Cliente atualizado com sucesso!' : '❌ Erro ao atualizar cliente. Verifique a conexão com o banco.';
        } else {
            $ok = $controller->salvar($nome, $cpf, $telefone, $email);
            $mensagem = $ok ? '✅ Cliente cadastrado com sucesso!' : '❌ Erro ao cadastrar cliente. Verifique a conexão com o banco.';
        }
    }
}

if (isset($_GET['editar'])) {
    $clienteEdit = $controller->buscarPorId((int)$_GET['editar']);
}

if (isset($_GET['deletar'])) {
    $ok = $controller->deletar((int)$_GET['deletar']);
    $mensagem = $ok ? '🗑️ Cliente excluído com sucesso!' : '❌ Erro ao excluir cliente.';
}

$clientes = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Locadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <span class="nav-titulo">🚗 Locadora de Veículos</span>
    <a href="index.php">Início</a>
    <a href="veiculos.php">Veículos</a>
    <a href="clientes.php" class="ativo">Clientes</a>
    <a href="alugueis.php">Aluguéis</a>
</nav>

<div class="pagina">
    <h1>👤 Gerenciar Clientes</h1>

    <?php if ($mensagem): ?>
        <div class="mensagem"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <div class="container">

        <!-- Formulário de cadastro/edição -->
        <div class="col-form">
            <h2><?php echo isset($clienteEdit) ? '✏️ Editar Cliente' : '➕ Novo Cliente'; ?></h2>
            <?php require_once 'view/cliente_form.php'; ?>
        </div>

        <!-- Tabela de clientes -->
        <div class="col-lista">
            <h2>Lista de Clientes</h2>

            <?php if (count($clientes) === 0): ?>
                <p class="sem-dados">Nenhum cliente cadastrado ainda.</p>

            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><?php echo (int)$c->getId(); ?></td>
                                <td><?php echo htmlspecialchars($c->getNome()); ?></td>
                                <td><?php echo htmlspecialchars($c->getCpf()); ?></td>
                                <td><?php echo htmlspecialchars($c->getTelefone()); ?></td>
                                <td><?php echo htmlspecialchars($c->getEmail()); ?></td>
                                <td>
                                    <a class="btn-editar" href="?editar=<?php echo (int)$c->getId(); ?>">Editar</a>
                                    <a class="btn-excluir"
                                       href="?deletar=<?php echo (int)$c->getId(); ?>"
                                       onclick="return confirm('Tem certeza que deseja excluir este cliente?');">
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
