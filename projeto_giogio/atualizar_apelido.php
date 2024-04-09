<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['novoApelido'])) {
    $novoApelido = $_POST['novoApelido'];
    $idUsuario = $_SESSION['usuario']['id'];

    require_once "config.php";
    $conexao = new Conexao();
    $conexao = $conexao->conectar();

    $stmt = $conexao->prepare("UPDATE usuarios SET apelido = :novoApelido WHERE id = :idUsuario");
    $stmt->bindParam(':novoApelido', $novoApelido);
    $stmt->bindParam(':idUsuario', $idUsuario);

    if ($stmt->execute()) {
        $_SESSION['usuario']['apelido'] = $novoApelido;
        header("Location: perfil.php");
        exit;
    } else {
        echo "Erro ao atualizar o apelido.";
    }
}
?>