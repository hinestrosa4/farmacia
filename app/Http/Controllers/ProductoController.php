<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Tipo;
use App\Models\Presentacion;
use App\Models\Proveedor;
use App\Models\Lote;
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

    public function addLote($id)
    {
        // dd($id);
        $datos = request()->validate([
            'stock' => 'required',
            'vencimiento' => 'required',
            'lote_id_prod' => '',
            'lote_id_prov' => '',
        ]);

        $datos['lote_id_prod'] = $id;

        Lote::create($datos);
        session()->flash('message', 'El lote se ha creado correctamente');
        return redirect()->route('listaProductos');
    }

    public function store()
    {
        $datos = request()->validate([
            'nombre' => '',
            'concentracion' => '',
            'adicional' => '',
            'precio' => '',
            'descuento' => '',
            'imagen' => '',
            'producto_lab' => '',
            'producto_tipo' => '',
            'producto_pre' => '',
        ]);

        // dd($datos);

        if (request()->hasFile('imagen')) {
            $nombre_imagen = request()->file('imagen')->getClientOriginalName();
            $datos['imagen'] = request()->file('imagen')->storeAs('img/productos', $nombre_imagen);
        }

        Producto::create($datos);
        session()->flash('message', 'El producto se ha creado correctamente');
        return redirect()->route('listaProductos');
    }

    public function updateProducto($id)
    {
        $producto = Producto::find($id);
        $datos = request()->validate([
            'nombre' => 'required',
        ]);

        $producto->update($datos);
        session()->flash('message', 'El producto ha sido modificado correctamente');
        return redirect()->route('listaProductos');
    }

    public function actualizarImagen(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreArchivo = $imagen->getClientOriginalName();

            // Eliminar la imagen anterior
            Storage::delete($producto->imagen);

            // Mover la imagen cargada al directorio adecuado
            $ruta_imagen = $imagen->move('img/productos', $nombreArchivo);

            // Actualizar la ruta de la imagen en la base de datos
            $producto->update(['imagen' => $ruta_imagen]);
        } else {
            // Si no se cargó una nueva imagen, mantener la imagen actual
            $ruta_imagen = "img/productos/sinFoto.png";
            $producto->update(['imagen' => $ruta_imagen]);
        }

        session()->flash('message', 'La imagen del producto se ha actualizado correctamente');
        return redirect()->route('listaProductos');
    }


    public function listar()
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $proveedores = Proveedor::all();
        $productos = Producto::orderBy('id', 'asc')->get();
        $usuario = Usuario::orderBy('id', 'asc')->get();
        return view('productos.listar', compact('productos', 'usuario', 'laboratorios', 'tipos', 'presentaciones', 'proveedores'));
    }

    public function altaProducto($id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);
        $producto->restore();
        session()->flash('message', 'El producto ha sido restaurado correctamente.');
        return redirect()->route('listaProductosBaja');
    }

    public function borrarProducto(Producto $producto)
    {
        $producto->delete();
        session()->flash('message', 'El producto ha sido borrada correctamente.');
        return redirect()->route('listaProductos');
    }

    public function listarBaja()
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $productos = Producto::orderBy('id', 'asc')->get();
        $usuario = Usuario::orderBy('id', 'asc')->get();
        return view('productos.listarBaja', compact('productos', 'usuario', 'laboratorios', 'tipos', 'presentaciones'));
    }


    public function detallesProducto($id)
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $producto = Producto::find($id);
        return view('productos.detalles', compact('producto', 'laboratorios', 'tipos', 'presentaciones'));
    }

    public function update($id)
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $producto = Producto::find($id);
        $datos = request()->validate([
            'nombre' => 'required',
            'concentracion' => 'required',
            'adicional' => 'required',
            'precio' => 'required',
            'descuento' => '',
            'producto_lab' => '',
            'producto_tipo' => '',
            'producto_pre' => '',
        ]);
        // dd($datos);
        $producto->update($datos);
        session()->flash('message', 'El producto ha sido modificado correctamente');
        return redirect()->route('detallesProducto', [$id, 'laboratorios' => $laboratorios, 'tipos' => $tipos, 'presentaciones' => $presentaciones]);
    }
}
