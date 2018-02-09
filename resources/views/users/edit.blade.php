@extends('layout')
@section('title', 'Crear un Usuario')
@section('content')
    <h1>Editando el usuario {{ $user->name }}</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <p>Por favor corregir los siguientes errores: </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ url("/usuarios/create/{$user->id}") }}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <label for="nombre">Nombre: </label>
        <input type="text" value="{{ old('name', $user->name) }}" id="nombre" name="name" /><br>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" /><br>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Mayor a 6 caracteres" "/><br>
        <input type="submit" value="Actualizar Usuario" />
    </form>
@endsection