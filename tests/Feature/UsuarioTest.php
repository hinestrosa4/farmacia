<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioTest extends TestCase
{

    //Menu principal, noticias

    public function test_datosPersonales()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/datosPersonales'
        $response = $this->get(route('datosPersonales', ['id' => 4]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'datosPersonales' fue cargada
        $response->assertViewIs('usuario.datosPersonales');
    }

    public function test_addUsuario()
    {
        $user = Usuario::where(
            'email',
            'pedro@gmail.com'
        )->first();

        $data = [
            'nombre' => 'Joaquin',
            'apellidos' => 'Gonzalez Ramos',
            'fecha_nacimiento' => '1997-02-07',
            'dni' => '13858850Q',
            'email' => 'joaquin@gmail.com',
            'password' => 'joaquin123',
            'tipo' => '1',
        ];

        $response = $this->actingAs($user)
            ->post('usuario', $data);

        $response = $this->get(route('gestionUsuario'));

        $response->assertStatus(200);
        $response->assertViewIs('usuario.listaUsuarios');
    }

    public function test_updateUsuario()
    {
        $user = Usuario::where(
            'email',
            'pedro@gmail.com'
        )->first();

        $data = [
            'nombre' => 'Joaquin',
            'apellidos' => 'Gonzalez Ramos',
            'fecha_nacimiento' => '1997-02-07',
            'dni' => '13858850Q',
            'email' => 'joaquin@gmail.com',
            'password' => 'joaquin123',
            'tipo' => '1',
        ];

        $response = $this->actingAs($user)
            ->post('usuario', $data);

        $response = $this->get(route('gestionUsuario'));

        $response->assertStatus(200);
        $response->assertViewIs('usuario.listaUsuarios');
    }

    public function test_gestionUsuario()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/gestionUsuario'
        $response = $this->get(route('gestionUsuario'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaUsuarios' fue cargada
        $response->assertViewIs('usuario.listaUsuarios');
    }

    public function test_gestionUsuarioBaja()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/gestionUsuarioBaja'
        $response = $this->get(route('gestionUsuarioBaja'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaUsuariosBaja' fue cargada
        $response->assertViewIs('usuario.listaUsuariosBaja');
    }
}
