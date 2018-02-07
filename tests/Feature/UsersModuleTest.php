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
    function it_shows_404_error_when_user_does_not_exists()
    {
        factory(Profession::class,10)->create();
        $user = factory(User::class)->create([
            'name'=>'Cristian Avila',
        ]);
        $this->get('/usuarios/9999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
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
        factory(Profession::class,10)->create();
        $user = factory(User::class)->create([
            'name'=>'Cristian Avila',
        ]);
        $this->get("/usuarios/".$user->id."/edit")
        ->assertStatus(200)
        ->assertSee("Editando el usuario 5");
    }
    /** @test */
    function it_show_404_error_when_id_is_not_numeric()
    {
        $this->get("/usuarios/texto/edit")
        ->assertStatus(404);
    }
    /** @test */
    function it_creates_a_new_user()
    {
        $this->post(route('users.store'), [
            'name'=>'Francisco Avila',
            'email'=>'paco@develhouse.com',
            'password'=>'123456'
        ])->assertRedirect(route('users'));
        $this->assertCredentials([
            'name'=>'Francisco Avila',
            'email'=>'paco@develhouse.com',
            'password'=>'123456'
        ]);
    }
    /** @test */
    function the_name_is_required()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name'=>'',
            'email'=>'paco@develhouse.com',
            'password'=>'123456'
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name'=>'El campo nombre es obligatorio']);
        $this->assertEquals(0,User::count());
    }
}
