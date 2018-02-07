@extends('layout')
    @section('activeEditar', 'active')
    @section('title', 'Editar un Usuario')
    @section('content')
        <h1>Editar Usuarios</h1>
        <p>Editando el usuario {{ $user->id }}</p>
    @endsection