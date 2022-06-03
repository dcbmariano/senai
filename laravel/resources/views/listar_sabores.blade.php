@extends('template.modelo')
@section('titulo', 'Escolha sua receita')
@section('conteudo')

<h2>Sabores:</h2>

  <p><a href="{{ url('/bolo/inserir') }}">Inserir novo sabor</a></p>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Receita</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
    </thead>

    <tbody>

     @foreach($sabores as $sabor)

      <tr>
        
        <!-- id -->
        <td>{{ $sabor->id }}</td>

        <!-- sabor -->
        <td>
          <a href="{{ url('/') }}/bolo/{{ $sabor->id }}" > 
            {{ ucfirst($sabor->titulo) }} 
          </a>
        </td>

        <!-- Editar -->
        <td>
          <a href="{{ url('/') }}/bolo/editar/{{ $sabor->id }}">
            Editar
          </a>
        </td>

        <!-- Apagar -->
        <td>
          <a href="{{ url('/') }}/bolo/deletar/{{ $sabor->id }}">
            Deletar
          </a>
        </td>

      </tr>  
     @endforeach

    </tbody>
  </table>


@endsection
