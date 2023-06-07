<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use PDF;

class EmailController extends Controller
{
    public function store($email)
    {
        $password = $this->generatePass(); // Generar contraseña aleatoria

        Mail::send('email.nueva-contrasena', ['password' => $password], function ($message) use ($email) {
            $message->to($email)
                ->subject('Nueva contraseña');
        });

        return $password;
    }

    // public function enviarRecibo($email, $venta_id)
    // {
    //     $venta = Venta::findOrFail($venta_id);
    //     $pdf = PDF::loadView('factura.factura', compact('venta'));
    //     $pdf_path = 'reciboVenta.pdf';
    //     $pdf->save($pdf_path);

    //     Mail::send('email.reciboPDF', ['venta' => $venta], function ($message) use ($email, $pdf_path) {
    //         $message->to($email)
    //             ->subject("Recibo")
    //             ->attach($pdf_path);
    //     });

    //     return redirect()->back();
    // }

    public function enviarRecibo($email, $venta_id)
    {
        $venta = Venta::findOrFail($venta_id);
        $pdf = PDF::loadView('factura.factura', compact('venta'));
        $pdf_content = $pdf->output();

        Mail::send('email.reciboPDF', ['venta' => $venta], function ($message) use ($email, $pdf) {
            $message->to($email)
                ->subject("Recibo")
                ->attachData($pdf->output(), 'Recibo.pdf');
        });

        return redirect()->back();
    }

    function generatePass()
    {
        $password = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_+=[]{}|;:,.<>?';

        $num_chars = strlen($chars);
        for ($i = 0; $i < 8; $i++) {
            $char = $chars[random_int(0, $num_chars - 1)];
            $password .= $char;
        }

        // Check if password has at least one uppercase letter, one lowercase letter, one number and one special character
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            // Generate a new password if it doesn't meet the requirements
            return $this->generatePass();
        }

        return $password;
    }
}
