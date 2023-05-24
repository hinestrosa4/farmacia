<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class LotesTest extends TestCase
{
    //Menu principal, noticias

    public function test_addLote()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'stock' => 10,
            'vencimiento' => '2023-12-31',
            'lote_id_prod' => 25,
            'lote_id_prov' => 1,
        ];

        // Enviar una solicitud POST a la ruta 'createProveedor' con los datos de entrada
        $response = $this->post(route('createLote'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('listaLotes'));

        // Verificar que el proveedor se haya creado en la base de datos
        $this->assertDatabaseHas('lote', [
            'stock' => 10,
            'vencimiento' => '2023-12-31',
            'lote_id_prod' => 25,
            'lote_id_prov' => 1,
        ]);
    }

    public function test_listaLotes()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('listaLotes'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('lotes.listaLotes');
    }

    public function test_editarLote()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('editarLote', ['id' => 2]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('lotes.editarLote');
    }

    public function test_gestionLotesEliminados()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta /configuracion'
        $response = $this->get(route('gestionLotesEliminados'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('lotes.listaLotesEliminados');
    }
}
