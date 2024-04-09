<?php

class ProjetoService
{
    private $conexao;
    private $usuario;

    public function __construct($conexao, $usuario)
    {
        $this->conexao = $conexao;
        $this->usuario = $usuario;
    }

    public function inserir()
    {
        $query = 'INSERT INTO usuarios (nome, senha, apelido, idade) VALUES (?, ?, ?, ?)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $this->usuario->nome);
        $stmt->bindParam(2, $this->usuario->senha);
        $stmt->bindParam(3, $this->usuario->apelido);
        $stmt->bindParam(4, $this->usuario->idade);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function buscarUsuario($nome, $senha)
    {
        $query = "SELECT * FROM usuarios WHERE nome = ? AND senha = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function buscarInformacoes($apelido, $idade)
    {
        $query = "SELECT * FROM usuarios WHERE apelido = ? AND idade = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $apelido);
        $stmt->bindParam(2, $idade);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function armazenaComentario($comentario){
        $query = "INSERT INTO comentarios (comentario) VALUES (:comentario)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
}
}
?>
