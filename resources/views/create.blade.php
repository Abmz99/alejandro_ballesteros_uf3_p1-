<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Película</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-4">Crear Nueva Película</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('createFilm') }}" method="POST">

        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="year">Año:</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="genre">Género:</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="form-group">
            <label for="country">País:</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="form-group">
            <label for="duration">Duración (minutos):</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>
        <div class="form-group">
            <label for="url_image">URL de la Imagen:</label>
            <input type="url" class="form-control" id="url_image" name="url_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Película</button>
    </form>

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Volver a la Lista de Películas</a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
