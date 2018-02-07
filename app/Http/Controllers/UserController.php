<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }
    public function show(User $user)
    {
        return view('users.show', compact('user', 'title'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>'',
            'password'=>'',
        ], [
            'name.required'=>'El campo nombre es obligatorio',
        ]);
        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])
        ]);
        return redirect()->route('users');
    }
}
