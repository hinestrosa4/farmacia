<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $usuario = Usuario::where('email', $request->email)->first();
            $time = date("H:i:s");
            $time = date("H:i:s", strtotime($time . "+1 hour"));

            if ($usuario->tipo === 1) {
                session(['administrador' => $time]);
                return redirect()->route('listaProductos', $usuario->id);
            }
            if ($usuario->tipo === 2) {
                session(['farmaceutico' => $time]);
                return redirect()->route('listaProductos', $usuario->id);
            }
            if ($usuario->tipo === 3) {
                session(['tecnico' => $time]);
                return redirect()->route('listaProductos', $usuario->id);
            }
            if ($usuario->tipo === 4) {
                session(['auxiliar' => $time]);
                return redirect()->route('listaProductos', $usuario->id);
            }
            // else {
            //     session(['operario' => $usuario->role]);
            //     session(['hora_login' => $time]);
            //     return redirect()->route('listaTareasOperario');
            // }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Correo o contraseña incorrectos']);
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('hora_login');
        session()->forget('administrador');
        return redirect('/');
    }
}
