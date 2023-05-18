<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class AtributosTest extends TestCase
{
    //Menu principal, noticias

    public function test_gestionAtributos()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('gestionAtributos'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('atributos.listar');
    }

    public function test_createLab()
    {
        $user = Usuario::where('email', 'pedro@gmail.com')->first();

        $response = $this->actingAs($user)
            ->post('laboratorio', [
                'nombre' => 'Laboratorio2',
            ]);

        $response = $this->get(route('createLab'));

        $response->assertStatus(200);

        $response->assertViewIs('atributos.listar');
    }
}
