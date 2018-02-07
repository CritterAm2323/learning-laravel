@extends('layout')
    @section('activeNuevo', 'active')
    @section('title', 'Crear un Usuario')
    @section('content')
        <h1>Creando un nuevo usuario</h1>
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
        <form method="post" action="{{route('users.store')}}">
            {!! csrf_field() !!}
            <label for="nombre">Nombre: </label>
            <input type="text" value="{{ old('name') }}" id="nombre" name="name" /><br>
            @if ($errors->has('name'))
                {{ $errors->first('name') }}
            @endif
            <br>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" /><br>
            @if ($errors->has('email'))
                {{ $errors->first('email') }}
            @endif
            <br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" placeholder="Mayor a 8 caracteres" "/><br>
            @if ($errors->has('password'))
                {{ $errors->first('password') }}
            @endif
            <br>
            <input type="submit" value="Crear Usuario" />
        </form>
    @endsection