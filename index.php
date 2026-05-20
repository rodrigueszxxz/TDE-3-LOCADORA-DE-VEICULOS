<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Locadora de Veículos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .cards {
            display: flex;
            gap: 24px;
            margin-top: 30px;
            flex-wrap: wrap; 
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-decoration: none;
            color: 
            flex: 1;
            min-width: 200px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border-top: 4px solid 
        }

        .card:hover {
            transform: translateY(-4px); 
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }

        .card .icone {
            font-size: 48px;
            display: block;
            margin-bottom: 12px;
        }

        .card h3 {
            margin: 0 0 8px 0;
            color: 
            font-size: 18px;
        }

        .card p {
            margin: 0;
            color: 
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Menu de navegação -->
<nav>
    <span class="nav-titulo">🚗 Locadora de Veículos</span>
    <a href="index.php" class="ativo">Início</a>
    <a href="veiculos.php">Veículos</a>
    <a href="clientes.php">Clientes</a>
    <a href="alugueis.php">Aluguéis</a>
</nav>

<div class="pagina">
    <h1>Bem-vindo ao Sistema</h1>
    <p style="color:#666;">Selecione uma área para gerenciar:</p>

    <!-- Cards de acesso rápido -->
    <div class="cards">

        <!-- Card Veículos -->
        <a href="veiculos.php" class="card">
            <span class="icone">🚘</span>
            <h3>Veículos</h3>
            <p>Cadastrar, editar e excluir veículos da frota</p>
        </a>

        <!-- Card Clientes -->
        <a href="clientes.php" class="card">
            <span class="icone">👤</span>
            <h3>Clientes</h3>
            <p>Cadastrar, editar e excluir clientes</p>
        </a>

        <!-- Card Aluguéis -->
        <a href="alugueis.php" class="card">
            <span class="icone">📋</span>
            <h3>Aluguéis</h3>
            <p>Registrar e gerenciar aluguéis de veículos</p>
        </a>

    </div>
</div>

</body>
</html>
