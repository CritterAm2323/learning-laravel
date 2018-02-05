@extends('layout')
    @section('activeDetalles', 'active')
    @section('title', 'Detalles de un Usuario')
    @section('content')
        <h1>{{ $title }}</h1>
        <p>Mostrando detalle del usuario: {{ $user->id }}</p>
        <p><strong>Nombre: </strong> {{ $user->name }}</p>
        <p><strong>Correo: </strong> {{ $user->email }}</p>
        <p><strong>Profesi&oacute;n: </strong> {{ $user->profession->title }}</p>
    @endsection