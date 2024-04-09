<?php

class Conexao{
    private $host = 'localhost';
    private $dbname = 'php_projeto';
    private $user = 'root';
    private $password = '';
    private $conexao;

    public function conectar(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->password"
            );

            return $conexao;
        }catch (PDOException $e){
            echo '<p>' .$e->getMessage(). '</p>';
        }
    }
}


?>