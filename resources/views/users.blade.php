<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Listado de Usuarios</title>

    </head>
    <body>
        <h1>{{ $title }}</h1>
        <hr />
            <ul>
                @forelse($users as $user)
                    <li>{{ $user }}</li>
                @empty
                    <li>No hay usuarios registrados</li>
                @endforelse
            </ul>
    </body>
</html>