<?php
session_start();

require_once "projeto.controller.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nome']) && !empty($_POST['senha'])) {
        $conexao = new Conexao();
        $projetoService = new ProjetoService($conexao->conectar(), null);

        $usuario = $projetoService->buscarUsuario($_POST['nome'], $_POST['senha']);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            header("Location: home.php");
            exit;
        } else {
            $msg_error = "Nome de usuário ou senha incorretos. Por favor, tente novamente.";
        }
    } else {
        $msg_error = "Por favor, preencha todos os campos.";
    }
}

if (isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center black-bg">
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-4">
                            <div class="card login-box">
                                <div class="card-body text-center">
                                    <img src="imagens/logo.png" class="img-fluid rounded-circle mb-4" alt="Logo" style="width: 100px; height: 100px;">
                                    <?php if (isset($msg_error)) : ?>
                                        <p style="color: red;"><?php echo $msg_error; ?></p>
                                    <?php endif; ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nome" placeholder="Nome de usuário" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </form>
                                    <p class="mt-3">Não tem uma conta? <a href="cadastro.php" class="btn btn-secondary">Cadastre-se</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
