{{-- Dentro de resources/views/actors/list.blade.php --}}

@extends('layouts.master')

@section('title', 'Lista de Actores')

@section('content')
    <h1>Lista de Actores</h1>
    <ul>
        @foreach ($actors as $actor)
            <li>{{ $actor->name }} - {{ $actor->birthdate }}</li> 
        @endforeach
    </ul>
@endsection
