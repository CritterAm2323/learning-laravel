<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function welcomeName($name)
    {
        $name = ucfirst($name);
        return "Bienvenido {$name}";
    }
    public function welcomeNameNickname($name, $nickname)
    {
        $name = ucfirst($name);
        return "Bienvenido {$name} tu apodo es {$nickname}";
    }
}