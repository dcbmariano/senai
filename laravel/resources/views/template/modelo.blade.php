<!doctype html>
<html lang="pt-BR">
<head>

    <title>@yield('titulo')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, 
                         initial-scale=1, shrink-to-fit=no">

    <link href="{{ url('/') }}/estilo.css" rel="stylesheet">

</head>
<body>

    <header>
        <h1><a href="{{url('/bolo')}}">Receitas de bolo</a></h1>
    </header>

    <div id="conteudo">

        <!-- Inicio do conteudo -->
        @yield('conteudo') 
        <!-- Fim do conteudo -->

    </div>

    <footer>
        <p>Todos os direitos reservados.</p>
    </footer>

</body>
</html>