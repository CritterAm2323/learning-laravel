<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** @test */
    function it_loads_the_user_list()
    {
        $this->get("/usuarios")
        ->assertStatus(200)
        ->assertSee("Usuarios")
        ->assertSee("Mily")
        ->assertSee("Joha");
    }
    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get("/usuarios?empty")
        ->assertStatus(200)
        ->assertSee("No hay usuarios registrados");
    }
    /** @test */
    function it_loads_the_user_detalis_page()
    {
        $this->get("/usuarios/5")
        ->assertStatus(200)
        ->assertSee("Mostrando detalle del usuario: 5");
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
