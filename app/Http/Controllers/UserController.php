<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;

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
            'email'=>['required','email', 'unique:users,email'],
            'password'=>'required|min:6',
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
    public function update(User $user)
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>['required','email', Rule::unique('users')->ignore($user->id)],
            'password'=>'nullable|min:6',
        ], [
            'name.required'=>'El campo nombre es obligatorio',
        ]);
        if($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('users.show', compact('user'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }
}