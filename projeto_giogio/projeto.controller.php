<?php

require_once "projeto.model.php";
require_once "projeto.services.php";
require_once "config.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$comentario = isset($_GET['comentario']) ? $_GET['comentario'] :'';

if ($acao == 'cadastrar') {
    $usuario = new Usuario();
    $usuario->nome = $_POST['nome'];
    $usuario->senha = $_POST['senha'];
    $usuario->apelido = $_POST['apelido'];
    $usuario->idade = $_POST['idade'];

    $conexao = new Conexao();
    $projetoService = new ProjetoService($conexao->conectar(), $usuario);
    if ($projetoService->inserir()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário!";
    }
}
?>
