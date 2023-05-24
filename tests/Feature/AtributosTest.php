<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Laboratorio;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;


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

    public function testStoreLab()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'nombre' => 'LaboratorioPrueba',
        ];

        // Enviar una solicitud POST a la ruta 'createLab' con los datos de entrada
        $response = $this->post(route('createLab'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('gestionAtributos'));

        // Verificar que el laboratorio se haya creado en la base de datos
        $this->assertDatabaseHas('laboratorio', [
            'nombre' => 'LaboratorioPrueba',
        ]);
    }

    public function BorrarLab()
    {
        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        // Crear un laboratorio de prueba
        $laboratorio = Laboratorio::create([
            'nombre' => 'Laboratorio de prueba',
        ]);

        // Enviar una solicitud de eliminación al método borrarLab del controlador
        $response = $this->delete(route('borrarLab', ['laboratorio' => $laboratorio]));

        // Verificar que el laboratorio haya sido borrado
        $this->assertDatabaseMissing('laboratorio', ['id' => $laboratorio->id]);
    }

    public function testStoreTipo()
    {

        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'nombre' => 'TipoPrueba',
        ];

        // Enviar una solicitud POST a la ruta 'createLab' con los datos de entrada
        $response = $this->post(route('createTipo'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('gestionAtributos'));

        // Verificar que el laboratorio se haya creado en la base de datos
        $this->assertDatabaseHas('tipo_producto', [
            'nombre' => 'TipoPrueba',
        ]);
    }

    public function testStorePre()
    {

        // Autenticar al usuario
        $user = Usuario::where('email', 'pedro@gmail.com')->first();
        $this->actingAs($user);

        $this->withoutExceptionHandling(); // Opcional, para mostrar detalles de excepciones en caso de error

        // Simular datos de entrada
        $datos = [
            'nombre' => 'PrePrueba',
        ];

        // Enviar una solicitud POST a la ruta 'createLab' con los datos de entrada
        $response = $this->post(route('createPresentacion'), $datos);

        // Verificar que se haya redireccionado correctamente
        $response->assertRedirect(route('gestionAtributos'));

        // Verificar que el laboratorio se haya creado en la base de datos
        $this->assertDatabaseHas('presentacion', [
            'nombre' => 'PrePrueba',
        ]);
    }
}
