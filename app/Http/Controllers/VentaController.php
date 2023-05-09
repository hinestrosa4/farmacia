<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Laboratorio;
use App\Models\Presentacion;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VentaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $usuarios = usuario::orderBy('id', 'asc')->get();
        $ventas = Venta::all()->toArray();
        // dd($ventas);
        return view('venta.listar', compact('ventas', 'usuarios'));
    }

    public function ventaProductos()
    {
        $laboratorios = Laboratorio::all();
        $tipos = Tipo::all();
        $presentaciones = Presentacion::all();
        $proveedores = Proveedor::all();
        $productos = Producto::orderBy('id', 'asc')->get();
        $usuario = Usuario::orderBy('id', 'asc')->get();
        return view('venta.ventaProductos', compact('productos', 'usuario', 'laboratorios', 'tipos', 'presentaciones', 'proveedores'));
    }

    public function store($ventaS)
    {
        $venta = json_decode($ventaS);
        // var_dump($venta);
        $datos = request()->validate([
            // 'id' => '',
            'fecha' => '',
            'cliente' => '',
            'metodoPago' => '',
            'total' => '',
            'productos' => '',
            'vendedor' => '',
        ]);
        // dd($venta);
        // $datos['id'] = $venta[0];
        $datos['fecha'] = $venta[0];
        $datos['cliente'] = $venta[1];
        $datos['metodoPago'] = $venta[2];
        $datos['total'] = $venta[3];
        $datos['vendedor'] = $venta[4];
        $datos['productos'] = json_encode($venta[5]);

        $productos = json_decode($datos['productos'], true);

        foreach ($productos as $producto) {
            $nombre = $producto[0][0];
            $cantidad = $producto[3][0];
            $productoDb = Producto::where('nombre', $nombre)->first();
            $productoDb->stock -= $cantidad;
            $productoDb->save();
        }
        Venta::create($datos);
        return redirect()->route('listaProductos');
    }

    public function borrarVenta(Venta $venta)
    {
        $venta->delete();
        session()->flash('message', 'La venta ha sido borrada correctamente.');
        return redirect()->route('gestionVentas');
    }

    public function enviarFactura($email, Venta $venta)
    {
        $emailController = new EmailController();
        $emailController->enviarRecibo($email, $venta);

        session()->flash('message', 'El correo ha sido enviado correctamente.');
        return redirect()->route('gestionVentas');
    }
}
