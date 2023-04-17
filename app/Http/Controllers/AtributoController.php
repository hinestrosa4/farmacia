<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Tipo;
use App\Models\Presentacion;
use Illuminate\Http\Request;

class AtributoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('atributos.listar');
    }

    public function storeLab()
    {
        $datos = request()->validate([
            'nombre' => 'required',
        ]);

        Laboratorio::create($datos);
        session()->flash('message', 'El laboratorio se ha creado correctamente');
        return redirect()->route('gestionAtributos');
    }

    public function storeTipo()
    {
        $datos = request()->validate([
            'nombre' => 'required',
        ]);

        Tipo::create($datos);
        session()->flash('message', 'El tipo se ha creado correctamente');
        return redirect()->route('gestionAtributos');
    }

    public function storePresentacion()
    {
        $datos = request()->validate([
            'nombre' => 'required',
        ]);

        Presentacion::create($datos);
        session()->flash('message', 'La presentación se ha creado correctamente');
        return redirect()->route('gestionAtributos');
    }

    // public function confirmarBorrar(Cliente $cliente)
    // {
    //     return view('confirmacionBorrarCliente', compact('cliente'));
    // }

    // public function borrarCliente(Cliente $cliente)
    // {
    //     $cliente->delete();
    //     session()->flash('message', 'El cliente ha sido borrada correctamente.');
    //     return redirect()->route('listaClientes');
    // }
}
