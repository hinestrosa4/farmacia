<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $usuario = Usuario::orderBy('id', 'asc')->get();        
        return view('usuario.datosPersonales', compact('usuario'));
    }

//    public function listar()
// {
//     $productos = Producto::orderBy('id', 'asc')->get();
//     return view('productos.listar', compact('productos'));
// }


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
