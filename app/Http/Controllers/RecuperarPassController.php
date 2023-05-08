<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Hash;

class RecuperarPassController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'email' => 'required',
        ]);

        $emailController = new EmailController();
        $password = $emailController->store($data['email']);

        // Buscamos el usuario correspondiente al correo proporcionado
        $usuario = Usuario::where('email', $data['email'])->first();
        if ($usuario) {
            $usuario->update(['password' => Hash::make($password)]);
        } else {
            // Manejar el caso en el que no se encuentra ningún usuario con el correo electrónico proporcionado
        }

        session()->flash('message', 'El correo ha sido enviado correctamente.');
        return redirect()->route('login');
    }
}
