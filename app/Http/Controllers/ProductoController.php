<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Tipo;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function actualizarImagen(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        // Si se cargó una nueva imagen, actualizar la ruta de la imagen en la base de datos
        if ($request->hasFile('imagen')) {
            Storage::delete($producto->imagen); // Eliminar la imagen anterior
            $nombre_imagen = $request->file('imagen')->getClientOriginalName();
            $ruta_imagen = $request->file('imagen')->storeAs('img', $nombre_imagen);
            $producto->update(['imagen' => $ruta_imagen]);
        }

        // Si no se cargó una nueva imagen, mantener la imagen actual
        else {
            $ruta_imagen = $producto->imagen;
        }

        session()->flash('message', 'La imagen del producto se ha actualizado correctamente');
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
