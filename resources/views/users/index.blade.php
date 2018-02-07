@extends('layout')
@section('activeHome', 'active')
@section('title', 'Listado de Usuarios')
@section('content')
        <h1>Listado de Usuarios</h1>
        <hr />
            <ul>
                @forelse($users as $user)
                    <li>
                        {{ $user->name }}, {{ $user->email }}
                        <a href="{{ route('users.show', ['id'=>$user->id]) }}">Ver Detalles</a>
                    </li>
                @empty
                    <li>No hay usuarios registrados</li>
                @endforelse
            </ul>
@endsection
@section('sidebar')
    @parent
    Instrucciones del listado de usuarios 
@endsection
