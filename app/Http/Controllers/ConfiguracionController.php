<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Http\Rules\Validaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = request()->user();
        return view('configuracion.inicio', compact('user'));
    }

    public function listarImagenes()
    {
        $user = request()->user();
        return view('configuracion.listarImagenes', compact('user'));
    }

    public function subirImagen(Request $request)
    {
        // Validar que se ha enviado una imagen
        $request->validate([
            'imagen' => 'required|array',
            'imagen.*' => 'image'
        ]);

        // Obtener el archivo o archivos de imagen
        $imagenes = $request->file('imagen');

        // Recorrer el arreglo de imágenes para guardar cada una
        foreach ($imagenes as $imagen) {
            // Generar un nombre único para el archivo de imagen
            $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();

            // Mover el archivo de imagen a la carpeta deseada
            $imagen->move(public_path('img/productos'), $nombreArchivo);
        }

        return redirect()->back()->with('success', 'Imagen(es) actualizada(s) correctamente.');
    }
}
