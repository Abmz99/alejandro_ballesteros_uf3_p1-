<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Titulo - @yield('titulo')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        @section('header')
            <h1>CABECERA DE LA WEB (MASTER)</h1>
            <img src="{{asset('img/banner.jpg')}}" >
            @show 
            <hr>
            <div class="container">
                @yield('content')
            </div>
            <hr>
            @section('footer')
            <h1>PIE DE PAGINA (MASTER)</h1>
            <img src="{{asset('img/footer.jpg')}}" >
        @show
    </body>
</html>