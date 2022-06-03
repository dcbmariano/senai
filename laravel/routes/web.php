<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web (traduzido em pt-br)
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para seu aplicativo. Essas
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora crie algo grande!
|
*/

// declaração do controller
use App\Http\Controllers\ReceitaController; 

// rota deve apontar para o controller
Route::get('/bolo/', [ReceitaController::class, 'listar']);
Route::get('/bolo/inserir', [ReceitaController::class, 'inserir']);
Route::post('/bolo/gravar', [ReceitaController::class, 'gravar']);
Route::get('/bolo/deletar/{id}', [ReceitaController::class, 'deletar']);
Route::get('/bolo/{id}', [ReceitaController::class, 'receita']);
Route::get('/bolo/editar/{id}', [ReceitaController::class, 'editar']);
Route::post('/bolo/atualizar', [ReceitaController::class, 'atualizar']);



// Route::get('/', function () {

//     $dados['nome'] = 'José';
//     return view('welcome', $dados);

// });

// Route::get('/exemplos', fn() => 'Exemplos');

// Route::get(
//     '/exemplos/{id}', 
//     fn($id) => "Exemplo $id"
// )->where('id', '[0-9]{1,8}');


// // grupo de rotas
// Route::domain('{sub}.localhost')->group(function(){

//     // rota teste
//     Route::get('/teste/{id}', function($sub, $id){
//         return "Subdomínio: $sub <br>Exemplo $id";
//     });

//     // rota outro-teste
//     Route::get('/outro-teste/{id}', function($sub, $id){
//         return "Subdomínio: $sub <br>Outro exemplo $id";
//     });

// });


/*
Route::match(['get', 'post'], '/', function () {
    // match ( [ array com rotas ], [ endereço ] , [ ação ] )
});

use App\Http\Controllers\UserController;

Route::get('/usuarios', [UserController::class, 'show']);


# parâmetros
 
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});


Route::get('/user/{name}', function ($name) {
    //
})->where('name', '[A-Za-z]+');
 
Route::get('/user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');
 
Route::get('/user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

*/