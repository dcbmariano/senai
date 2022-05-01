<?php 

class Model{

    // dados de acesso
    private $usuario = 'root';
    private $senha = '';
    private $host = '127.0.0.1';
    private $porta = '3306';
    private $base = 'teste';

    protected $pdo; 

    // função construtora: conecta com o banco 
    function __construct(){

        try {
            // conecta com o banco
            $this->pdo = new PDO(
                "mysql:host=$this->host;
                    port=$this->porta;
                    dbname=$this->base", 
                $this->usuario, 
                $this->senha
            );

            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            );

            echo "<small>Conexão com o banco de dados 
                    realizada com sucesso.</small><br>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
}