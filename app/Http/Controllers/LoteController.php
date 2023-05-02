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

    public function editarLote($id)
    {
        $lote = Lote::find($id);
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        // dd($lote);
        return view('lotes.editarLote', compact('lote', 'productos', 'proveedores'));
    }

    public function update($id)
    {
        $lote = Lote::find($id);
        $datos = request()->validate([
            'stock' => 'required',
            'vencimiento' => 'required',
            'lote_id_prov' => '',
            'lote_id_prod' => '',
        ]);
        // dd($datos);
        $lote->update($datos);
        session()->flash('message', 'El lote ha sido modificado correctamente');
        return redirect()->route('editarLote', $id);
    }

    public function borrarLote(Lote $lote)
    {
        $lote->delete();
        session()->flash('message', 'El lote ha sido borrada correctamente.');
        return redirect()->route('listaLotes');
    }

    public function  gestionLotesEliminados(Request $request)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $lotes = Lote::orderBy('id', 'asc')->get();
        return view('lotes.listaLotesEliminados', compact('lotes', 'productos', 'proveedores'));
    }

    public function altaLote($id)
    {
        $lote = Lote::withTrashed()->findOrFail($id);
        $lote->restore();
        session()->flash('message', 'El lote ha sido restaurado correctamente.');
        return redirect()->route('gestionLotesEliminados');
    }
}
