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
        factory(Profession::class, 10)->create();
        factory(User::class)->create([
            'name' => 'Mily',
        ]);
        factory(User::class)->create([
            'name' => 'Joha',
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
            ->assertSee("No hay usuarios Registrados");
    }

    /** @test */
    function it_displays_the_user_detalis()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create([
            'name' => 'Cristian Avila',
        ]);
        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee('Cristian Avila');
    }

    /** @test */
    function it_shows_404_error_when_user_does_not_exists()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create([
            'name' => 'Cristian Avila',
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
    function it_show_404_error_when_id_is_not_numeric()
    {
        $this->get("/usuarios/texto/edit")
            ->assertStatus(404);
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->post(route('users.store'), [
            'name' => 'Francisco Avila',
            'email' => 'paco@develhouse.com',
            'password' => '123456'
        ])->assertRedirect(route('users'));
        $this->assertCredentials([
            'name' => 'Francisco Avila',
            'email' => 'paco@develhouse.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => '',
            'email' => 'paco@develhouse.com',
            'password' => '123456'
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_is_required()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Cristian Avila',
            'email' => '',
            'password' => '123456'
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_is_not_valid()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Cristian Avila',
            'email' => 'email-no-valido',
            'password' => '123456'
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique()
    {
        factory(Profession::class, 10)->create();
        factory(User::class)->create([
            'email' => 'cristian@develhouse.com',
        ]);
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Cristian Avila',
            'email' => 'cristian@develhouse.com',
            'password' => '123456',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Cristian Avila',
            'email' => 'cristian@develhouse.com',
            'password' => ''
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_password_must_have_at_least_6_characters()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Cristian Avila',
            'email' => 'cristian@develhouse.com',
            'password' => '1234'
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->get("/usuarios/{$user->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });
    }

    /** @test */
    function it_updates_a_user()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->put("/usuarios/create/{$user->id}", [
            'name' => 'Francisco Avila',
            'email' => 'paco@develhouse.com',
            'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name' => 'Francisco Avila',
            'email' => 'paco@develhouse.com',
            'password'=>'123456'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => '',
                'email' => 'paco@develhouse.com',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        $this->assertDatabaseMissing('users', ['email'=>'paco@develhouse.com']);
    }
    /** @test */
    function the_email_is_required_when_updating()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => 'Cristian Avila',
                'email' => '',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name'=>'Cristian Avila']);
    }

    /** @test */
    function the_email_is_not_valid_when_updating()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => 'Cristian Avila',
                'email' => 'email-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users', ['name'=>'Cristian Avila']);
    }

    /** @test */
    function the_email_must_be_unique_when_updating()
    {
        factory(Profession::class, 10)->create();
        factory(User::class)->create([
            'email' => 'existing-email@example.com',
        ]);
        $user = factory(User::class)->create([
            'email'=>'cristian@develhouse.com',
        ]);
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => 'Cristian Avila',
                'email' => 'existing-email@example.com',
                'password' => '123456',
            ])
            ->assertRedirect("/usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function the_password_is_optional_when_updating()
    {
        $oldPassword = 'clave_anterior';
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create([
            'password'=>  bcrypt($oldPassword),
        ]);
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => 'Cristian Avila',
                'email' => 'cristian@develhouse.com',
                'password'=>''
            ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name'=>'Cristian Avila',
            'email' => 'cristian@develhouse.com',
            'password'=>$oldPassword,
        ]);
    }
    /** @test */
    function the_email_can_stay_the_same_when_updating()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create([
            'email'=>  'cristian@develhouse.com',
        ]);
        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/create/{$user->id}", [
                'name' => 'Cristian Avila',
                'email' => 'cristian@develhouse.com',
                'password'=>'12345678'
            ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertDatabaseHas('users',[
            'name'=>'Cristian Avila',
            'email' => 'cristian@develhouse.com',
        ]);
    }
    /** @test */
    function it_deletes_a_user()
    {
        factory(Profession::class, 10)->create();
        $user = factory(User::class)->create();
        $this->delete("/usuarios/{$user->id}")
        ->assertRedirect(route('users'));
        $this->assertDatabaseMissing('users', [
            'id'=>$user->id
        ]);
    }
}