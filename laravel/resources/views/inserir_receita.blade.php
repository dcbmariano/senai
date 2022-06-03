@extends('template.modelo')
@section('titulo', 'Inserir receita')

@section('conteudo')

<div>
  <h2>Cadastrar nova receita</h2>
  
  <form 
    action="{{ url('/bolo/gravar') }}" 
    method="POST" 
    class="inserir"
    enctype="multipart/form-data" 
  >
    @csrf
    <div>
      <label><strong>Receita</strong></label>
      <input 
        type="text" 
        placeholder="Digite o nome da receita" 
        name="receita"
      >
    </div>

    <div>
      <label><strong>Ingredientes</strong></label>
      <textarea 
        type="text" 
        rows="5" 
        placeholder="Digite os ingredientes" 
        name="ingredientes"
      ></textarea>
    </div>

    <div>
      <label><strong>Modo de preparo</strong></label>
      <textarea 
        type="text" 
        rows="5" 
        placeholder="Descreva o modo de preparo" 
        name="preparo"
      ></textarea>
    </div>

    <input type="file" name="foto">
    <input type="submit" name="enviar">

  </form>

</div>

@endsection
