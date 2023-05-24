<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Producto;

class VentaTest extends TestCase
{
    //Menu principal, noticias

    public function addVenta()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de venta
        $venta = [
            '2023-05-24',
            'Cliente',
            'Metodo de Pago',
            100.0,
            'Vendedor',
            [
                [
                    ['Producto1'],
                    ['Descripción1'],
                    [10.0],
                    [5],
                ],
                [
                    ['Producto2'],
                    ['Descripción2'],
                    [20.0],
                    [3],
                ],
            ],
        ];

        // Convertir los datos de venta a formato JSON
        $ventaS = json_encode($venta);

        // Enviar una solicitud POST a la ruta 'createVenta' con los datos de venta
        $response = $this->post(route('createVenta', $ventaS));

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('listaProductos'));

        // Verificar que se hayan actualizado los stocks de los productos
        $this->assertEquals(5, Producto::where('nombre', 'Producto1')->first()->stock);
        $this->assertEquals(2, Producto::where('nombre', 'Producto2')->first()->stock);

        // Verificar que la venta se haya creado en la base de datos
        $this->assertDatabaseHas('ventas', [
            'fecha' => '2023-05-24',
            'cliente' => 'Cliente',
            'metodoPago' => 'Metodo de Pago',
            'total' => 100.0,
            'vendedor' => 'Vendedor',
            'productos' => json_encode([
                [
                    ['Producto1'],
                    ['Descripción1'],
                    [10.0],
                    [5],
                ],
                [
                    ['Producto2'],
                    ['Descripción2'],
                    [20.0],
                    [3],
                ],
            ]),
        ]);
    }

    public function test_ventaProductos()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('ventaProductos'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('venta.ventaProductos');
    }

    public function test_grafico()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('graficos'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('venta.grafico');
    }
}
