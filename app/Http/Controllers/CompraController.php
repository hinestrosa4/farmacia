<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class CompraController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('compra.tramitarCompra');
    }

    public function pagotarjeta(Request $request)
    {
        // Configurar la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Crear un cargo en Stripe
        $charge = Charge::create([
            'amount' => 10,  // Monto en centavos (ejemplo:10.00€)
            'currency' => 'eur',
            'source' => $request->stripeToken,
        ]);

        // Aquí puedes realizar acciones adicionales después de un pago exitoso
        session()->flash('message', 'Pago realizado.');
        return redirect()->route('gestionVentas');
    }
}
