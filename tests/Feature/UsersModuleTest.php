<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Profession;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function it_loads_the_user_list()
    {
        factory(Profession::class,10)->create();
        factory(User::class)->create([
            'name'=>'Mily',
        ]);
        factory(User::class)->create([
            'name'=>'Joha',
        ]);
        $this->get("/usuarios")
        ->assertStatus(200)
        ->assertSee("Listado de Usuarios")
        ->assertSee("Mily")
        ->assertSee("Joha");
    }
    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get("/usuarios")
        ->assertStatus(200)
        ->assertSee("No hay usuarios registrados");
    }
    /** @test */
    function it_displays_the_user_detalis()
    {
        factory(Profession::class,10)->create();
        $user = factory(User::class)->create([
           'name'=>'Cristian Avila',
        ]);
        $this->get('/usuarios/' . $user->id)
        ->assertStatus(200)
        ->assertSee('Cristian Avila');
    }
    /** @test */
    function it_loads_the_new_user_page()
    {
        $this->get("/usuarios/nuevo")
        ->assertStatus(200)
        ->assertSee("Creando un nuevo usuario");
    }
    /** @test */
    function it_loads_the_edit_users_page()
    {
        $this->get("/usuarios/5/edit")
        ->assertStatus(200)
        ->assertSee("Editando el usuario 5");
    }
    function it_show_404_error_when_id_is_not_numeric()
    {
        $this->get("/usuarios/texto/edit")
        ->assertStatus(404);
    }
}
