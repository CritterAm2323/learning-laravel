<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() 
    {
        if(request()->has('empty')) {
            $users = [];
        } else {
            $users = User::all();
        }
        $title = 'Listado de Usuarios';
        return view('users.index',compact('users', 'title'));
    }
    public function show($id)
    {
        $user = User::find($id);
        $title = 'Detalles de Usuario';
        return view('users.show', compact('user', 'title'));
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
