<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LotesController extends Controller
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
        return view('lotes.listaLotes', compact('lotes'));
    }

    public function borrarLote(Lote $lote)
    {
        $lote->delete();
        session()->flash('message', 'El lote ha sido borrada correctamente.');
        return redirect()->route('listaLotes');
    }
}
