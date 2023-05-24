<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class ProductoTest extends TestCase
{
    //Menu principal, noticias

    public function addProducto()
    {
        // Autenticar al usuario
        $user = Usuario::where(
            'email',
            'pedro@gmail.com'
        )->first();

        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'nombre' => 'Nombre',
            'concentracion' => '10 mg',
            'adicional' => '10',
            'precio' => 9,
            'stock' => 0,
            'imagen' => 'img/productos/sinFoto.png',
            'producto_lab' => 7,
            'producto_tipo' => 1,
            'producto_pre' => 2,
        ];

        // Enviar una solicitud POST a la ruta 'createProveedor' con los datos de entrada
        $response = $this->post(route('createProduct'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('listaProductos'));

        // Verificar que el proveedor se haya creado en la base de datos
        $this->assertDatabaseHas('producto', [
            'nombre' => 'Nombre',
            'concentracion' => '10mg',
            'adicional' => '10',
            'precio' => 9,
            'stock' => 0,
            'imagen' => 'img/productos/sinFoto.png',
            'producto_lab' => 7,
            'producto_tipo' => 1,
            'producto_pre' => 2,
        ]);
    }

    public function test_listaProductos()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('listaProductos'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('productos.listar');
    }

    public function test_listaProductosBaja()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('listaProductosBaja'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('productos.listarBaja');
    }

    public function test_detallesProducto()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('detallesProducto', ['id' => 21]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('productos.detalles');
    }
}
