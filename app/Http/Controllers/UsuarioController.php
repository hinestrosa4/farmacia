<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Rules\Validaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = $request->user();
        return view('usuario.datosPersonales', compact('user'));
    }

    public function  gestionUsuarioView(Request $request)
    {
        $user = $request->user();
        return view('usuario.listaUsuarios', compact('user'));
    }

    public function store(Request $request)
    {
        $datos = request()->validate([
         'nombre'=>'',
         'apellidos'=>'',
         'fecha_nacimiento'=>'',
         'dni'=>'',
         'email'=>'',
         'password'=>'',
         'tipo'=>'',

        ]);

        $datos['password'] = Hash::make($datos['password']);

        Usuario::create($datos);
        session()->flash('message', 'El usuario se ha creado correctamente');
        return redirect()->route('gestionUsuario');

        //return view('formRegCliente');
    }

    public function update($id)
    {
        $usuario = Usuario::find($id);
        $datos = request()->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => '',
            'email' => 'required|email',
            'sexo' => 'required',
        ]);

        $usuario->update($datos);
        session()->flash('message', 'El usuario ha sido modificado correctamente');
        return redirect()->route('datosPersonales', $usuario->id);
    }

    public function updatePassword($id)
    {
        $usuario = Usuario::find($id);
        $datos = request()->validate([
            'password' => 'required',
            'passwordConfirm' => 'required',
        ]);

        $datos['password'] = Hash::make($datos['password']);

        $usuario->update($datos);
        session()->flash('message', 'La contraseña ha sido cambiada correctamente');
        return redirect()->route('datosPersonales', $usuario->id);
    }
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
