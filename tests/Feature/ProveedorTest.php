<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class ProveedorTest extends TestCase
{
    //Menu principal, noticias

    public function test_addProveedor()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'nombre' => 'ProveedorPrueba',
            'telefono' => '628733851',
            'email' => 'email@gmail.com',
            'direccion' => 'dprueba',
        ];

        // Enviar una solicitud POST a la ruta 'createLab' con los datos de entrada
        $response = $this->post(route('createProveedor'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('listaProveedores'));

        // Verificar que el laboratorio se haya creado en la base de datos
        $this->assertDatabaseHas('proveedor', [
            'nombre' => 'ProveedorPrueba',
            'telefono' => '628733851',
            'email' => 'email@gmail.com',
            'direccion' => 'dprueba',
        ]);
    }

    public function test_listaProveedores()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('listaProveedores'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('proveedor.listaProveedores');
    }

    public function test_perfilProveedor()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('perfilProveedor', ['id' => 2]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('proveedor.perfilProveedor');
    }

    public function test_listaProveedoresBaja()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('listaProveedoresBaja'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('proveedor.listaProveedoresBaja');
    }
}
