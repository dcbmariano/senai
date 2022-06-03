@extends('template.modelo')
@section('titulo', 'Inserir receita')

@section('conteudo')

<div>
  <h2>Editar receita</h2>
  
  <form 
    action="{{ url('/bolo/atualizar') }}" 
    method="POST" 
    class="inserir"
  >
    @csrf
    <div>
      <label><strong>Receita</strong></label>
      <input 
        type="text" 
        value="{{ $titulo }}" 
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
      >{{ $ingredientes }}</textarea>
    </div>

    <div>
      <label><strong>Modo de preparo</strong></label>
      <textarea 
        type="text" 
        rows="5" 
        placeholder="Descreva o modo de preparo" 
        name="preparo"
      >{{ $modo_preparo }}</textarea>
    </div>
    <input type="hidden" value="{{ $fechadura }}" name="fechadura">
    <input type="submit" name="atualizar" value="Atualizar">

  </form>

</div>

@endsection
