<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Rules\Validaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('register');
    }

    public function store()
    {
        $datos = request()->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'edad' => 'required',
            'dni' => ['required', function ($attribute, $value, $fail) {
                $validarCIF = new Validaciones();
                if (!$validarCIF->validateDNI($value)) {
                    $fail("The " . $attribute . ' is invalid.');
                }
            }],
            'email' => 'required|email',
            'password' => 'required',
            'tipo' => 'required',
        ]);

        $datos['password'] = Hash::make($datos['password']);

        Usuario::create($datos);
        session()->flash('message', 'El usuario ha sido registrado correctamente');
        return redirect()->route('login');

        //return view('formRegCliente');
    }
}
