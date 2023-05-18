<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class LoginTest extends TestCase
{

    //Menu principal, noticias

    public function test_login()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'luisa@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /'
        $response = $this->get(route('login'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('login');
    }
}
