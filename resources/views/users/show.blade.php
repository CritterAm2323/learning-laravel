@extends('layout')
    @section('activeDetalles', 'active')
    @section('title', 'Detalles de un Usuario')
    @section('content')
        <h1>{{ $title }}</h1>
        <p>Mostrando detalle del usuario: {{ $id }}</p>
    @endsection