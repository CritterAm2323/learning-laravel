<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        if(request()->has('empty')) {
            $users = [];
        } else {
            $users = [
                'Mily','Joha','Paquito','Vane','Jorge',
            ];
        }
        $title = 'Listado de Usuarios';
        return view('users',compact('users', 'title'));
    }
    public function show($id)
    {
        return "Mostrando detalle del usuario: {$id}";
    }
    public function create()
    {
        $title = "Creando un nuevo usuario";
        return view('user-create', compact('title'));
    }
    public function edit($id)
    {
        return "Editando el usuario {$id}";
    }
}
