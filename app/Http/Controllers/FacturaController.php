<?php

namespace App\Http\Controllers;

use App\Mail\NosecaenMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Models\Venta;
use App\Models\Cliente;

class FacturaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($ventaID)
    {
        // $venta = json_decode($ventaS);
        // $cuota = Cuota::findOrFail($id);

        $venta = Venta::where('id', $ventaID)->first();
        // dd($venta);

        // $pdf = PDF::loadView('factura', compact('cuota', 'cliente', 'tipo_cambio'));
        $pdf = PDF::loadView('factura.factura', compact('venta'));

        return $pdf->stream('ticketVenta.pdf');
    }
}
