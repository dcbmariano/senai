<?php

require 'model/Alunos.php';

/**
 * Controlador Alunos
 */
class AlunoController
{
    function listar(){

        // instancia o método alunos
        $Alunos = new Alunos();

        // busca todos os alunos
        $alunos = $Alunos->listar();

        // carrega a view alunos
        require 'view/alunos.php';
    }

    function inserir(){
        if(isset($_POST['nome'])){
             // instancia o método alunos
            $Alunos = new Alunos();

            // grava o aluno
            $aluno = $Alunos->salvar($_POST['nome']);
            
            // pega todos os alunos
            $alunos = $Alunos->listar('id', 'desc');

            // carrega a view alunos
            //require 'view/alunos.php';
            header('Location: /');
        }
    }

    function deletar(){
        $id = $_GET['id'];
        // instancia o método alunos
        $Alunos = new Alunos();
        $Alunos->deletar($id);

        header('Location: /');
    }

    function editar(){
        $id = $_GET['id'];
        $Alunos = new Alunos();

        if(!isset($_POST['editar'])){
            // dados do aluno
            $dados = $Alunos->buscar($id);

            // preenche variáveis nome/id
            foreach($dados as $d){
                $id = $d['id'];
                $nome = $d['nome'];
            }

            //$aluno = $Alunos->editar($id);
            $alunos = $Alunos->listar();

            // carrega a view alunos
            require 'view/alunos.php';
        }
        else{
            // atualiza dados
            $id = $_POST['id'];
            $novo_nome = $_POST['nome'];

            // atualiza dados no banco
            $Alunos->atualizar($id, $novo_nome);

            // VOLTAR PRA HOME
            header('Location: /');
        }

    }
}
