<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

//use Illuminate\Http\UploadedFile;


class ReceitaController extends Controller{

    public function listar(){
    	/* 
    	*  Carrega a view que lista 
    	*  todas as receitas do site 
    	*/

        $dados['sabores'] = Receitas::all();

        return view('listar_sabores', $dados);
    }

    public function receita($id){
    	/* 
    	*  Carrega a view que lista 
    	*  todas as receitas do site 
    	*/
    	
        $dados['sabor'] = Receitas::findOrFail($id);

        return view('receita', $dados);
    }

    public function deletar($id){

        if(is_numeric($id)){
            Receitas::findOrFail($id)->delete();
            return redirect('/bolo');
        }
        else{
            return redirect('/bolo');
        }
    }

    public function inserir(){
        return view('inserir_receita');
    }

public function gravar(Request $request){

    // novo objeto que conecta a tabela Receitas
    $receitas = new Receitas;

    // Recebendo dados via formulário
    $receita = $request->receita;
    $ingredientes = $request->ingredientes;
    $preparo = $request->preparo;

    // Gravando dados no banco
    $receitas->titulo = $receita;
    $receitas->ingredientes = $ingredientes;
    $receitas->modo_preparo = $preparo;

    $receitas->save();

    // pega o id do item que foi gravado
    $id = $receitas->id;

    // upload de arquivo
    $imagem = $request->file('foto');
    $nome_imagem = $id.'.'.$imagem->getClientOriginalExtension();
    $pasta = public_path('/data/');
    $imagem->move($pasta, $nome_imagem);

    return redirect('/bolo');
}

    public function editar($id){

        // busca dados no servidor
        $dados = Receitas::findOrFail($id);

        // criptografa o id
        $dados['fechadura'] = Crypt::encryptString($dados->id);

        // carrega a view enviado os dados
        return view('editar', $dados);

    }

    private function chave($fechadura){
        return Crypt::decryptString($fechadura);
    }

    public function atualizar(Request $request){

        // descriptografa id
        $id = ReceitaController::chave($request->fechadura);

        // dados vindos do formulário
        $titulo = $request->receita; 
        $ingredientes = $request->ingredientes;
        $modo_preparo = $request->preparo;

        // atualiza banco
        $atualizar = Receitas::where('id', $id)->update(
            [   
                'titulo'=>$titulo, 
                'ingredientes'=> $ingredientes, 
                'modo_preparo'=>$modo_preparo
            ]
        );

        return redirect('/bolo');
    }

}