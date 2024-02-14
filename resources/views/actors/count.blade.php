{{-- Dentro de resources/views/actors/count.blade.php --}}

@extends('layouts.master') 

@section('title', 'Conteo de Actores') 

@section('content')
    <h1>Conteo de Actores</h1>
    <p>Hay un total de {{ $count }} actores registrados.</p>
@endsection
