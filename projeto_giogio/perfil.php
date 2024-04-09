<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['usuario']['nome'];
$idadeUsuario = $_SESSION['usuario']['idade'];
$apelidoUsuario = $_SESSION['usuario']['apelido'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-box">
                    <h2>Perfil de Usuário</h2>
                    <p><strong>Nome:</strong> <?php echo $nomeUsuario; ?></p>
                    <p><strong>Apelido:</strong> <?php echo $apelidoUsuario; ?></p>

                    <form action="atualizar_apelido.php" method="post">
                        <label for="novoApelido">Novo Apelido:</label>
                        <input type="text" id="novoApelido" name="novoApelido" class="form-control" required>
                        <br>
                        <input type="submit" value="Atualizar Apelido" class="btn btn-primary">
                    </form>

                    <a href="home.php" class="btn btn-primary mt-3">Voltar para o Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>