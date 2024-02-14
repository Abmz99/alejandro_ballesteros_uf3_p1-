<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Películas</title>
    <!-- Añadir CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container">
    @extends('layouts.master')

    @section('header')
        @parent()
    @endsection

    @section('content')
        <h1 class="mt-4">Lista de Películas</h1>
        <ul>
            <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
            <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
            <li><a href="/filmout/films">Pelis</a></li>
            <li><a href="/filmout/sortFilms">Pelis ordenadas por año descendiente</a></li>
            <li><a href="/filmout/countFilms">Contador de Pelis</a></li>
            <li><a href="{{ route('actors.count') }}">Contador de Actores</a></li>
            <li><a href="{{ route('actors.list') }}">Listar Actores</a></li>
            <form action="{{ route('actors.listByDecade') }}" method="GET">
                <div>
                    <label for="decade">Seleccione una década:</label>
                    <select name="year" id="decade">
                        @foreach (range(1980, 2020, 10) as $year)
                            <option value="{{ $year }}">{{ $year }} - {{ $year + 9 }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit">Buscar</button>
            </form>



        </ul>

        <h1 class="mt-4">Añadir Película</h1>
        @if (!empty($status))
            <p style="color:red;">{{ $status }}</p>
        @endif
        <form action="{{ route('createFilm') }}" method="POST">
            {{ csrf_field() }}
            <label for="nombre">Nombre</label>
            <input type="text" name="name" />
            <br>
            <label for="year">Año</label>
            <input type="number" name="year" />
            <br>
            <label for="genre">Género</label>
            <input type="text" name="genre" />
            <br>
            <label for="country">País</label>
            <input type="text" name="country" />
            <br>
            <label for="duration">Duración</label>
            <input type="number" name="duration" />
            <br>
            <label for="img_url">Imagen URL</label>
            <input type="text" name="img_url" />
            <br>
            <input type="submit" value="Enviar" />
        </form>

        <!-- Añadir JS de Bootstrap y Popper.js (necesarios para Bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @endsection

    @section('footer')
        @parent()
    @endsection
</body>

</html>
