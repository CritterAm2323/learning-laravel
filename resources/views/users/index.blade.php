@extends('layout')
@section('activeHome', 'active')
@section('title', 'Listado de Usuarios')
@section('content')
        <h1>{{ $title }}</h1>
        <hr />
            <ul>
                @forelse($users as $user)
                    <li><a href="usuarios/{{ $user->id }}">{{ $user->name }}, {{ $user->email }}</a></li>
                @empty
                    <li>No hay usuarios registrados</li>
                @endforelse
            </ul>
@endsection
@section('sidebar')
    @parent
    Instrucciones del listado de usuarios 
@endsection
