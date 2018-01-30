<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcomes_users_with_nickname()
    {
        $this->get("/saludo/cristian/critter")
        ->assertStatus(200)
        ->assertSee("Bienvenido Cristian tu apodo es critter");
    }
    /** @test */
    function it_welcomes_users_without_nickname()
    {
        $this->get("/saludo/cristian")
        ->assertStatus(200)
        ->assertSee("Bienvenido Cristian");
    }
}
