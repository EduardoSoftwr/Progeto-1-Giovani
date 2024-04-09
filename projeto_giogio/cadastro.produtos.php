<?php
session_start();

require_once "produto.class.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['usuario']['tipo'] !== 'administrador') {
    header("Location: acesso_negado.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $tipo = $_POST["tipo"];

    if ($tipo !== 'bebida' && $tipo !== 'tabaco') {
        echo "Tipo de produto inválido.";
        exit;
    }

    if ($tipo === 'bebida') {
        $produto = new Bebida($nome, $descricao, $valor, $tipo);
    } else {
        $produto = new Tabaco($nome, $descricao, $valor, $tipo);
    }

    require_once "config.php";
    $conexao = new Conexao();
    $conexaoBanco = $conexao->conectar();

    $produto->salvarNoBanco($conexaoBanco);

    header("Location: cadastro.produtos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cadastroprod.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Cadastrar Produto</h2>
                        <form action="cadastro.produtos.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" id="nome" name="nome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <input type="text" id="descricao" name="descricao" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor:</label>
                                <input type="text" id="valor" name="valor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="bebida">Bebida</option>
                                    <option value="tabaco">Tabaco</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Cadastrar" class="btn btn-primary">
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <button onclick="window.location.href='home.php';" class="btn btn-primary">Ir para a página de login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>