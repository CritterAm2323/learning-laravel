@extends('layout')
    @section('activeEditar', 'active')
    @section('title', 'Editar un Usuario')
    @section('content')
        <h1>{{ $title }}</h1>
        <p>Editando el usuario {{ $id }}</p>
    @endsection