<?php

namespace App\Controllers;

class ConectaAPI extends BaseController
{
    public function inserir(){
        $url = BACKEND_URL.'livros/inserir';

        $dados = $this->request->getPost();

        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];

        $contexto = stream_context_create($opcoes);

        try{
            $resultado = file_get_contents($url, false, $contexto);
            
            return redirect()->to('/')
                    ->with('mensagem', 'Livro <b>'.$dados['titulo'].'</b> inserido com sucesso')
                    ->with('tipo', 'success');
        }
        catch(\Exception $e){
            return redirect()->to('/')
                    ->with('mensagem', 'Erro ao inserir os dados') # : '.$e)
                    ->with('tipo', 'danger');
        }
    }


    public function deletar(){
        $url = BACKEND_URL.'livros/deletar';

        $dados = $this->request->getPost();

        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];

        $contexto = stream_context_create($opcoes);

        try{
            $resultado = file_get_contents($url, false, $contexto);
            
            return redirect()->to('/')
                    ->with('mensagem', 'Livro deletado com sucesso')
                    ->with('tipo', 'success');
        }
        catch(\Exception $e){
            return redirect()->to('/')
                    ->with('mensagem', 'Erro ao deletar dados') # : '.$e)
                    ->with('tipo', 'danger');
        }
    }


    public function editar(){
        $url = BACKEND_URL.'livros/editar';

        $dados = $this->request->getPost();

        $opcoes = [
            'http'=>[
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
                'method'=>'POST',
                'content'=>http_build_query($dados)
            ]
        ];

        $contexto = stream_context_create($opcoes);

        try{
            $resultado = file_get_contents($url, false, $contexto);
            
            if($resultado == 'Token inválido'){
                return redirect()->to('/')
                    ->with('mensagem', 'Erro ao atualizar dados: token inválido') # : '.$e)
                    ->with('tipo', 'danger');
            }
            return redirect()->to('/')
                    ->with('mensagem', 'Livro atualizado com sucesso')
                    ->with('tipo', 'success');
        }
        catch(\Exception $e){
            return redirect()->to('/')
                    ->with('mensagem', 'Erro ao atualizar dados') # : '.$e)
                    ->with('tipo', 'danger');
        }
    }

}