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
        return view('users.index',compact('users', 'title'));
    }
    public function show($id)
    {
        $title = 'Detalles de Usuario';
        return view('users.show', compact('id', 'title'));
    }
    public function create()
    {
        $title = "Creando un nuevo usuario";
        return view('users.create', compact('title'));
    }
    public function edit($id)
    {
        $title = "Editar Usuario";
        return view('users.edit', compact('id', 'title'));
    }
}
