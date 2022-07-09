<?php

namespace App\Controllers;

class ConectaAPI extends BaseController
{

    public function inserir(){
        
        // define a url de consulta
        $url = BACKEND_URL.'livros/inserir';

        // coleta os dados via post
        $dados = $this->request->getPost();

        // formata o envio à api
        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];
        
        // declara o contexto
        $contexto = stream_context_create($opcoes);

        // envia os dados
        try {
            $resultado = file_get_contents($url, false, $contexto);
            return redirect()->to('/')->with('mensagem','Livro <b>'.$dados['titulo'].'</b> inserido com sucesso.')->with('tipo','success');
        } catch (\Exception $e) {
            
            return redirect()->to('/')->with('mensagem','Erro ao inserir os dados.')->with('tipo', 'danger');
        }
        
    }

    public function deletar(){
        // define a url de consulta
        $url = BACKEND_URL.'livros/deletar/';

        // coleta os dados via post
        $dados = $this->request->getPost();

        // formata o envio à api
        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];

        // declara o contexto
        $contexto = stream_context_create($opcoes);

        // envia os dados
        try {
            $resultado = file_get_contents($url, false, $contexto);
            return redirect()->to('/')->with('mensagem','Livro deletado com sucesso.')->with('tipo','success');

        } catch (\Exception $e) {
            return redirect()->to('/')->with('mensagem','Erro ao deletar livro.')->with('tipo', 'danger');
        }
    }

    public function editar(){

        // coleta os dados via post
        $dados = $this->request->getPost();
        
        // define a url de consulta
        $url = BACKEND_URL.'livros/editar/';
        
        // formata o envio à api
        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];

        // declara o contexto
        $contexto = stream_context_create($opcoes);

        // envia os dados
        try {
            $resultado = file_get_contents($url, false, $contexto);
            return redirect()->to('/')->with('mensagem','Livro atualizado com sucesso.')->with('tipo','success');
            
        } catch (\Exception $e) {
            return redirect()->to('/')->with('mensagem','Erro ao atualizado livro.')->with('tipo', 'danger');
        }
    }

}
