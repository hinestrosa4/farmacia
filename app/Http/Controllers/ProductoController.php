<?php

namespace App\Http\Controllers;

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

    public function listar()
    {
        $productos = Producto::orderBy('id', 'asc')->get();
        $usuario = Usuario::orderBy('id', 'asc')->get();
        return view('productos.listar', compact('productos', 'usuario'));
    }

    public function borrarProducto(Producto $producto)
    {
        $producto->delete();
        session()->flash('message', 'El producto ha sido borrada correctamente.');
        return redirect()->route('listaProductos');
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
