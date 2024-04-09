<?php
$msg_success = "";
$msg_error = "";

require_once "projeto.controller.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nome']) || empty($_POST['senha']) || empty($_POST['apelido']) || empty($_POST['idade'])) {
        $msg_error = "Todos os campos são obrigatórios.";
    } else {
        $usuario = new Usuario();
        $usuario->nome = $_POST['nome'];
        $usuario->senha = $_POST['senha'];
        $usuario->apelido = $_POST['apelido'];
        $usuario->idade = $_POST['idade'];

        $conexao = new Conexao();
        $projetoService = new ProjetoService($conexao->conectar(), $usuario);
        if ($projetoService->inserir()) {
            $msg_success = "Cadastro realizado com sucesso! Você será redirecionado para a página de login.";
            header("refresh:2;url=login.php");
        } else {
            $msg_error = "Erro ao cadastrar usuário. Por favor, tente novamente mais tarde ou verifique os dados inseridos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>Cadastro de Usuário</h1>
                        <?php if ($msg_success) : ?>
                            <p class="success"><?php echo $msg_success; ?></p>
                        <?php endif; ?>
                        <?php if ($msg_error) : ?>
                            <p class="error"><?php echo $msg_error; ?></p>
                        <?php endif; ?>
                        <form action="cadastro.php" method="POST">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" id="nome" name="nome" class="form-control <?php echo isset($msg_error) && strpos($msg_error, "nome") !== false ? 'error' : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control <?php echo isset($msg_error) && strpos($msg_error, "senha") !== false ? 'error' : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="apelido">Apelido:</label>
                                <input type="text" id="apelido" name="apelido" class="form-control <?php echo isset($msg_error) && strpos($msg_error, "apelido") !== false ? 'error' : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="idade">Idade:</label>
                                <input type="number" id="idade" name="idade" class="form-control <?php echo isset($msg_error) && strpos($msg_error, "idade") !== false ? 'error' : ''; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>

                </div>
                <div class="container mt-3">
                    <a href="home.php" class="btn btn-primary">Retornar para Home</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>