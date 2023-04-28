<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Lote;
use App\Http\Rules\Validaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProveedorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $proveedor = request()->user();
        return view('proveedor.listaProveedores', compact('proveedor'));
    }

    public function store()
    {
        $datos = request()->validate([
            'nombre' => '',
            'telefono' => '',
            'email' => '',
            'direccion' => '', 
        ]);

        Proveedor::create($datos);
        session()->flash('message', 'El proveedor se ha creado correctamente');
        return redirect()->route('listaProveedores');

        //return view('formRegCliente');
    }

    public function update($id)
    {
        $proveedor = Proveedor::find($id);
        $datos = request()->validate([
            'nombre' => 'required',
            'direccion' => '',
            'telefono' => 'required',
        ]);
        $proveedor->update($datos);
        session()->flash('message', 'El proveedor ha sido modificado correctamente');
        return redirect()->route('perfilProveedor', $id);
    }

    public function perfilProveedor($id)
    {
        $proveedor = Proveedor::find($id);
        // dd($proveedor);
        return view('proveedor.perfilProveedor', compact('proveedor'));
    }
    
    public function listaProveedoresBaja()
    {
        $proveedor = request()->user();
        return view('proveedor.listaProveedoresBaja', compact('proveedor'));
    }
    
    public function borrarProveedor(Proveedor $proveedor)
    {
        $proveedor->delete();
        session()->flash('message', 'El proveedor ha sido borrada correctamente.');
        return redirect()->route('listaProveedores');
    }

    public function altaProveedor($id)
    {
        $proveedor = Proveedor::withTrashed()->findOrFail($id);
        $proveedor->restore();
        session()->flash('message', 'El proveedor ha sido dado de alta correctamente.');
        return redirect()->route('listaProveedoresBaja');
    }
}
