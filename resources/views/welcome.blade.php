<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Películas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Cambio de color de fondo del encabezado */
        header {
            background-color: #333; 
            color: #fff; 
            padding: 20px;
        }

        /* Estilo personalizado para los botones */
        .btn-custom {
            background-color: #ff5722;
            border-color: #ff5722; 
            color: #fff; 
        }
    </style>
</head>
<body class="container">

<header>
    <img src="{{ asset('storage/images/logostucom.png') }}" alt="Logo de tu empresa">
</header>

<h1 class="mt-4">Lista de Películas</h1>
<ul>
    <li><a href="{{ url('/filmout/oldFilms') }}">Pelis antiguas</a></li>
    <li><a href="{{ url('/filmout/newFilms') }}">Pelis nuevas</a></li>
    <li><a href="{{ url('/filmout/films') }}">Todas las pelis</a></li>
</ul>

<h2 class="mt-4">Añadir Nueva Película</h2>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<a href="{{ route('createFilm') }}" class="btn btn-custom">Crear Nueva Película</a>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<footer class="mt-4">
    <div class="container">
        <img src="{{ asset('storage/images/piepagina.png') }}" alt="Imagen de pie de página">
        <p>&copy; {{ date('Y') }} Stucom. Todos los derechos reservados.</p>
        <p>Politica de Privacidad | Terminos y Condiciones</p>
    </div>
</footer>

</body>
</html>
