@extends('layout')
@section('activeHome', 'active')
@section('title', 'Listado de Usuarios')
@section('content')
        <h1>Listado de Usuarios</h1>
        <hr />
        @if ($users->isNotEmpty())
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route("users.delete", $user) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                        <a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                        <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                    </form></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>No hay usuarios Registrados</p>
        @endif
@endsection
@section('sidebar')
    @parent
    Instrucciones del listado de usuarios 
@endsection
