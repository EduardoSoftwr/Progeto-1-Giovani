<?php

class Produto {
    protected $nome;
    protected $descricao;
    protected $valor;
    protected $tipo;

    public function __construct(...$args) {
        if (count($args) === 4) {
            list($this->nome, $this->descricao, $this->valor, $this->tipo) = $args;
        }
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function salvarNoBanco($conexao) {
        try {
            $query = 'INSERT INTO produtos (nome, descricao, valor, tipo) VALUES (?, ?, ?, ?)';
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(1, $this->nome);
            $stmt->bindParam(2, $this->descricao);
            $stmt->bindParam(3, $this->valor);
            $stmt->bindParam(4, $this->tipo);
            $stmt->execute();
            echo "Produto cadastrado com sucesso!";
        } catch(PDOException $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
        }
    }
}


class Bebida extends Produto {
}

class Tabaco extends Produto {
}

?>