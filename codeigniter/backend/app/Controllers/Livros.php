<?php

namespace App\Controllers;
use App\Models\LivrosModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class Livros extends BaseController
{
    use ResponseTrait;

    public function getIndex()
    {
        echo 'API de consulta de livros';
    }

    public function getListar($paginacao = 1, $ordem = 'asc'){
        /* 
        *  Uso: /listar/[página]/[ordem]/[itens] 
        *  Exemplo: /listar/1/desc/1
        *  Explicação: Retorna o último item
        */

        header('Access-Control-Allow-Origin: *');

        $livrosModel = new LivrosModel();
        $itens = 10;

        $dados = $livrosModel
                    ->orderBy('id', $ordem)
                    ->findAll($itens, $paginacao*$itens-$itens);

        return $this->respond($dados, 200);

    }

    public function getLivro($id){
        header('Access-Control-Allow-Origin: *');

        $livrosModel = new LivrosModel();
        $dados = $livrosModel->find($id);
        
        return $this->respond($dados, 200);

    }

    public function getBuscar($query){
        /* 
        *  Realiza uma busca por:
        *  titulo, autor, isbn ou período (ano_inicio e ano_fim)
        *  Exemplo: http://localhost:8080/livros/buscar/
        *            query?itens_por_pagina & titulo=sociedade do anel 
        *            & isbn=123 & autor=tolkien & ano_inicio=2000 & ano_fim=2020
        */

        header('Access-Control-Allow-Origin: *'); 

        // paginação
        $itens = isset($_GET['itens_por_pagina'])?$_GET['itens_por_pagina']:10;
        $pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

        // busca por título, autor ou isbn
        $titulo = isset($_GET['titulo'])?$_GET['titulo']:'';
        // Outra forma de obter o título:
        // $request = \Config\Services::request();
        // $titulo = $request->getVar('titulo');

        $isbn = isset($_GET['isbn'])?$_GET['isbn']:'';
        $autor = isset($_GET['autor'])?$_GET['autor']:'';
        
        // período de busca - padrão 0 até ano atual
        $ano_inicio = isset($_GET['ano_inicio'])?$_GET['ano_inicio']:0;
        $ano_fim = isset($_GET['ano_fim'])?$_GET['ano_fim']:date('Y');

        // cláusulas where
        $periodo = ['ano >='=>$ano_inicio, 'ano <='=>$ano_fim];
        $busca = ['titulo'=>$titulo, 'autor'=>$autor, 'isbn'=>$isbn];

        // conexão com o banco
        $livrosModel = new LivrosModel();

        $dados = $livrosModel
            ->where($periodo)
            ->like($busca)
            ->findAll($itens, $pagina*$itens-$itens);

        return $this->respond($dados, 200);

    }

    public function postInserir(){
        /* 
        *  Insere um item no banco de dados
        *  Requer: 
        *   titulo, autor, isbn, paginas, ano
        */

        header('Access-Control-Allow-Origin: *'); 

        $titulo = $_POST['titulo']; 
        $autor = $_POST['autor'];
        $isbn = $_POST['isbn'];
        $paginas = $_POST['paginas'];
        $ano = $_POST['ano'];
        
        // grava dados no banco
        $livrosModel = new LivrosModel();

        $livrosModel->save([
            'titulo'=>$titulo,
            'autor'=>$autor,
            'isbn'=>$isbn,
            'paginas'=>$paginas,
            'ano'=>$ano
        ]);
        
        $this->respondCreated($livrosModel->getInsertID());
    }

    public function postDeletar(){
        /* Deleta uma linha do banco com base no id passado */
    
        $id = $_POST['id'];
    
        $livrosModel = new LivrosModel();
        $livrosModel->delete(['id' => $id]);
    
        $this->respondDeleted($id);
    
    }
    private function autoriza($token){

        // criptografia simples base64
        $token = base64_encode($token);

        // dados aqui devem estar criptografados
        $tokens_aceito = [
            "QmVhcmVyIDMyZjRhMTRiNWFkZDYxM2E5ZWU2OTgxYjdkZmUzYmY="
        ];

        // verifica se o token é aceito
        if(in_array($token, $tokens_aceito)){
            return true;
        }
        else{
            echo "Token inválido";
            exit();
        }
    }
    public function postEditar(){
        /* 
        *  Atualiza um item no banco de dados
        *  Requer: id
        *  Opcional: titulo, autor, isbn, paginas, ano
        */

        $id = $_POST['id'];

        $livrosModel = new LivrosModel();

        // autorização básica usando tokens
        // TOKEN-EXEMPLO = "Bearer 32f4a14b5add613a9ee6981b7dfe3bf"
        // CHAVE-EQUIVALENTE = "QmVhcmVyIDMyZjRhMTRiNWFkZDYxM2E5ZWU2OTgxYjdkZmUzYmY="

        if(isset($_SERVER["HTTP_AUTHORIZATION"])){
            $token = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else {
            $token = $_POST['token'];
        }

        
        Livros::autoriza($token);

        // busca dados originais pelo id
        $dados_antigos = $livrosModel->find($id);

        // caso não encontre, retorna um erro
        if($dados_antigos['id'] != $id){
            exit();
        }

        // novos valores
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $isbn = $_POST['isbn'];
        $paginas = $_POST['paginas'];
        $ano = $_POST['ano'];
        $agora = new Time('now');

        $dados = [
            'titulo'=>$titulo,
            'autor'=>$autor,
            'isbn'=>$isbn,
            'paginas'=>$paginas,
            'ano'=>$ano,
            'updated_at'=>$agora
        ];        

        $livrosModel->update($id, $dados);

        // resposta genérica
        $this->respond($dados, 200);
    }
    

    // public function getPovoar_banco(){
    //     /* 
    //     *  Função responsável por povoar os dados do banco. 
    //     *  Lê o arquivo "livros.csv"
    //     *  Separador ";"
    //     */ 
    //     // conectando ao banco
    //     $livrosModel = new LivrosModel();

    //     //d($livrosModel->findAll()); // imprime dados na tela
    //     //return 0;
     
    //     // lendo arquivo CSV
    //     if (($arquivo = fopen("livros.csv", "r")) !== FALSE) {
     
    //         echo '<table border=1>'; // imprime uma tabela no HTML
     
    //         $id_linha = 1;
    //         // para cada linha do arquivo CSV
    //         while(($linha = fgetcsv($arquivo, 4096, ";")) !== FALSE){
     
    //             // para cada coluna da linha
    //             for ($i=0; $i < count($linha); $i++) {
     
    //                 switch($i){
    //                     case 0: $titulo = $linha[$i]; break;
    //                     case 1: $autor = $linha[$i]; break;
    //                     case 2: $isbn = $linha[$i]; break;
    //                     case 3: $paginas = $linha[$i]; break;
    //                     case 4: $ano = $linha[$i]; break;
    //                 }
    //             }
     
    //             // grava dados no banco
    //             if($id_linha != 1){
    //                 $livrosModel->save([
    //                     'titulo'=>$titulo,
    //                     'autor'=>$autor,
    //                     'isbn'=>$isbn,
    //                     'paginas'=>$paginas,
    //                     'ano'=>$ano
    //                 ]);
    //             }
    //             $id_linha++;
     
    //         }
     
    //         fclose($arquivo); // fecha o arquivo
    //     }
        
    //     d($livrosModel->findAll()); // imprime dados na tela
     
    //     echo "Para limpar a base de dados, execute: ";
    //     echo "php spark migrate:refresh";
    // }
    

}
