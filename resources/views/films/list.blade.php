{{-- resources/views/films/list.blade.php --}}

<h1>{{ $title }}</h1>

@if(empty($films))
    <p style="color: red;">No se ha encontrado ninguna película.</p>
@else
    <div align="center">
        <table border="1">
            <thead>
                <tr>
                    <!-- Verifica si el array films no está vacío y es un array -->
                    @if(!empty($films) && is_array($films) && count($films) > 0)
                        <!-- Obtiene las claves del primer elemento del array -->
                        @foreach(array_keys(reset($films)) as $key)
                            <th>{{ ucfirst($key) }}</th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                    <tr>
                        @foreach($film as $key => $value)
                            <!-- Verifica si la clave es 'img_url' para mostrar la imagen -->
                            @if($key === 'img_url')
                                <td><img src="{{ $value }}" style="width: 100px; height: 120px;" alt="Imagen de película"></td>
                            @else
                                <td>{{ $value }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
