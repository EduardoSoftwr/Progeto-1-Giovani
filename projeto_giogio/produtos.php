<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['usuario']['nome'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="css/produtos.css" rel="stylesheet">
    <style>
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="">
                <nav>
                    <ul>
                        <li><a href="home.php" class="sair">Home</a>
                        <li><a href="perfil.php" class="sair">Perfil</a>

                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <h2 class="produto-titulo">Produtos</h2>

    <div class="produtos-container">
        <?php
        require_once 'produto.class.php';
        require_once 'config.php';

        $conexao = new Conexao();
        $pdo = $conexao->conectar();

        $stmt = $pdo->prepare("SELECT * FROM produtos");
        $stmt->execute();

        $produtos = $stmt->fetchAll(PDO::FETCH_CLASS, 'Produto');

        $contador = 0;

        foreach ($produtos as $produto) {
            echo "<div class='produto-box'>";
            if ($produto->getTipo() === 'bebida') {

                echo "<img src='imagens/Bebida.png' alt='Bebida' class='produto-imagem'>";
            } elseif ($produto->getTipo() === 'tabaco') {
                echo "<img src='imagens/Tabaco.png' alt='Tabaco' class='produto-imagem'>";
            }
            echo "<div class='produto-nome'>{$produto->getNome()}</div>";
            echo "<div class='produto-valor'>R$ {$produto->getValor()}</div>";
            echo "</div>";

            $contador++;

            if ($contador == 3) {
                echo "<div style='width: 100%;'></div>";
                $contador = 0;
            }
        }
        ?>
    </div>
</body>

</html>