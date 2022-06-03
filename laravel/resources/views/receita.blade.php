@extends('template.modelo')
@section('titulo', $sabor->titulo)

@section('conteudo')

<div>
	<h2>{{ $sabor->titulo }}</h2>

	<?php 
		echo "<img 
				src='".url("/")."/data/$sabor->id.jpg' 
				width='300px'
			  >";
	?>
	
	<h3>INGREDIENTES</h3>
	<pre>
		{{ $sabor->ingredientes }}
	</pre>
	
	<h3>PREPARO</h3>
	<pre>
		{{ $sabor->modo_preparo }}
	</pre>

</div>

@endsection
