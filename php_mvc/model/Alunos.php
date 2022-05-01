<?php

/**
 * Model Aluno
 */
class Alunos extends Model
{
    function listar($ordem = 'id', $sentido = 'asc'){
        // lista todos os alunos

        $sql = $this->pdo->prepare("select * from alunos 
        order by $ordem $sentido");
        $sql->execute();
        
        return $sql;
        
    }

    function buscar($id){
        // busca um aluno com base no id
        $sql = $this->pdo->prepare("select * from alunos 
        where id = $id");
        $sql->execute();

        return $sql;
    }

    function salvar($nome){
        // grava um novo aluno no banco de dados
        try{
            // comando SQL 
            $sql = $this->pdo->prepare("INSERT INTO 
                    alunos (nome) VALUES(?)");

            // executando o comando => $nome substituirá o símbolo "?"
            $sql->execute([$nome]);

            // Dados salvos com sucesso
            echo "<small>Linhas inseridas na base de dados:"
                    .$sql->rowCount()."</small>";
        } catch(PDOException $e) {
            // um erro ocorreu
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function atualizar($id, $novo_nome){
        // atualiza os dados de um aluno
        try{
            // comando SQL 
            $sql = $this->pdo->prepare("UPDATE ALUNOS set 
                    nome = '$novo_nome' where id = $id");

            $sql->execute();

        } catch(PDOException $e) {
            // um erro ocorreu
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function deletar($id = null){

        if($id == null){ 
            echo "Não é permitido apagar toda a base de dados. "; 
            die(); 
        }

        // deleta um aluno
        try{
            // comando SQL 
            $sql = $this->pdo->prepare("delete from alunos where id=?");
    
            // executando o comando => $nome substituirá o símbolo "?"
            $sql->execute([$id]);
    
            // Dados salvos com sucesso
            echo "<small>Linhas deletadas:"
                    .$sql->rowCount()."</small>";

            echo "<br><a href='/'>Voltar.</a>";

        } catch(PDOException $e) {
            // um erro ocorreu
            echo 'Erro: ' . $e->getMessage();
        }
    }

}


