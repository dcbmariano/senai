<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){

        // página inicial
        $page = 1;
        $data['anterior'] = $page;
        $data['proxima'] = $page+1;
        $data['page'] = $page;

        // determinando a última página
        $raw = file_get_contents(BACKEND_URL."livros/listar/1/desc");
        $ultima_pagina = (array)json_decode($raw);
        $ultimo_id = $ultima_pagina[0]->id;
        $data['fim'] = intval($ultimo_id/10)+1;

        return view('home', $data);
    }

    public function pagina($page = 1){

        if($page==1){ 
            $data['anterior'] = $page; 
        }
        else{ 
            $data['anterior'] = $page-1; 
        }
        $data['proxima'] = $page+1;
        $data['page'] = $page;

        // determinando a última página
        $raw = file_get_contents(BACKEND_URL."livros/listar/1/desc");
        $ultima_pagina = (array)json_decode($raw);
        $ultimo_id = $ultima_pagina[0]->id;
        $data['fim'] = intval($ultimo_id/10)+1;

        return view('home', $data);
    }

    public function editar($id){

        $raw = file_get_contents(BACKEND_URL."livros/livro/$id");
        $data = (array)json_decode($raw);

        return view('editar', $data);
    }

    public function inserir(){
        return view('inserir');
    }

    public function deletar($id){
        $data['id'] = $id;
        return view('deletar', $data);
    }
}
