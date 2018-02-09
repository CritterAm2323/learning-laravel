<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Home';
});
Route::get('/usuarios', 'UserController@index')
    ->name('users');
Route::get('/usuarios/{user}', 'UserController@show')->where("user", "[0-9]+")
    ->name('users.show');
Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');
Route::post('/usuarios/create', 'UserController@store')
    ->name('users.store');
Route::put('/usuarios/create/{user}', 'UserController@update')
    ->name('users.update');
Route::get('/usuarios/{user}/edit', 'UserController@edit')->where('user', '[0-9]+')
    ->name('users.edit');
Route::delete("/usuarios/{user}", "UserController@destroy")
    ->name('users.delete');