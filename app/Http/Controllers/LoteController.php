<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $lotes = Lote::all();
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        // dd($lotes);
        return view('lotes.listaLotes', compact('lotes', 'productos', 'proveedores'));
    }

    public function store()
    {
        $datos = request()->validate([
            'stock' => '',
            'vencimiento' => '',
            'lote_id_prod' => '',
            'lote_id_prov' => '',
        ]);

        Lote::create($datos);
        session()->flash('message', 'El lote se ha creado correctamente');
        return redirect()->route('listaLotes');
    }

    public function borrarLote(Lote $lote)
    {
        $lote->delete();
        session()->flash('message', 'El lote ha sido borrada correctamente.');
        return redirect()->route('listaLotes');
    }
}
