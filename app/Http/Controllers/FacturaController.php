<?php

namespace App\Http\Controllers;

use App\Mail\NosecaenMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Models\Cuota;
use App\Models\Cliente;

class FacturaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($ventaS)
    {
        $venta = json_decode($ventaS);
        // $cuota = Cuota::findOrFail($id);
        // dd($venta);

        // $cliente = Cliente::where('id', $cuota['clientes_id'])->first();

        // $pdf = PDF::loadView('factura', compact('cuota', 'cliente', 'tipo_cambio'));
        $pdf = PDF::loadView('factura.factura', compact('venta'));

        return $pdf->stream('ticketVenta.pdf');
    }
}
