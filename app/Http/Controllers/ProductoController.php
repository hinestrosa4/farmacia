<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Tipo;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function store()
    {
        $datos = request()->validate([
            'nombre' => '',
            'concentracion' => '',
            'adicional' => '',
            'precio' => '',
            'imagen' => '',
            'producto_lab' => '',
            'producto_tipo' => '',
            'producto_pre' => '',
        ]);

        if (request()->hasFile('imagen')) {
            $nombre_imagen = request()->file('imagen')->getClientOriginalName();
            $datos['imagen'] = request()->file('imagen')->storeAs('img', $nombre_imagen);
        }

        Producto::create($datos);
        session()->flash('message', 'El producto se ha creado correctamente');
        return redirect()->route('listaProductos');
    }



    public function listar()
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $productos = Producto::orderBy('id', 'asc')->get();
        $usuario = Usuario::orderBy('id', 'asc')->get();
        return view('productos.listar', compact('productos', 'usuario', 'laboratorios', 'tipos', 'presentaciones'));
    }

    public function borrarProducto(Producto $producto)
    {
        $producto->delete();
        session()->flash('message', 'El producto ha sido borrada correctamente.');
        return redirect()->route('listaProductos');
    }
}
