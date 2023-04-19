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
            $nombreArchivo = $imagen->getClientOriginalName();

            // Mover el archivo de imagen a la carpeta deseada
            $imagen->move(public_path('img/productos'), $nombreArchivo);
        }
        return redirect()->back()->with('message', 'Imagen(es) actualizada(s) correctamente.');
    }

    public function eliminarImagen(Request $request)
    {
        // Obtener el nombre de archivo de la imagen a eliminar
        $filename = $request->input('filename');

        // Eliminar la imagen de la ruta especificada
        $rutaImagen = public_path('img/productos/' . $filename);
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }

        // Redirigir de vuelta a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'La imagen ha sido eliminada correctamente.');
    }
}
