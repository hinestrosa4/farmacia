<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Proveedor;
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
    public function __invoke()
    {
    }

    public function store($ventaS)
    {
        $venta = json_decode($ventaS);
        // var_dump($venta);
        $datos = request()->validate([
            'id' => '',
            'fecha' => '',
            'cliente' => '',
            'metodoPago' => '',
            'total' => '',
            'productos' => '',
            'vendedor' => '',
        ]);
        // dd($venta);
        $datos['id'] = $venta[0];
        $datos['fecha'] = $venta[1];
        $datos['cliente'] = $venta[2];
        $datos['metodoPago'] = $venta[3];
        $datos['total'] = $venta[4];
        $datos['vendedor'] = $venta[5];
        $datos['productos'] = json_encode($venta[6]);


        Venta::create($datos);
        return redirect()->route('listaProductos');
    }
}
