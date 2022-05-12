<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    }

    public function comprar(Request $request)
    { // STRIPE

        if (Auth::user()->hasPermissionTo('soy-agente') || Auth::user()->hasPermissionTo('soy-agente_inversor')) {
            return redirect()->back();
        }


        $cantidad = $request->get('cantidad');
        $nombre = $request->get('name_user');
        $email = $request->get('email_user');

        if (Auth::user()->getRoleNames()[0] != "inversor" && Auth::user()->getRoleNames()[0] != "mayorista-dispositivos") {
            if ($cantidad >= 0 && $cantidad < 5000) {
                switch ($cantidad) {
                    case ($cantidad >= 0 && $cantidad < 300):
                        $saldo_regalado = $cantidad * 0.03;
                        break;

                    case ($cantidad >= 300 && $cantidad < 500):
                        $saldo_regalado = $cantidad * 0.06;
                        break;

                    case ($cantidad >= 500 && $cantidad < 999):
                        $saldo_regalado = $cantidad * 0.07;
                        break;

                    case ($cantidad >= 1000 && $cantidad < 5000):
                        $saldo_regalado = $cantidad * 0.09;
                        break;
                }
            } else {
                return redirect()->route('saldo.index')->with('error', 'Error al realizar la compra.');
            }
        } else {
            if ($cantidad >= 60 && $cantidad < 5000) {
                switch ($cantidad) {
                    case ($cantidad >= 60 && $cantidad < 300):
                        $saldo_regalado = 0;
                        break;

                    case ($cantidad >= 300 && $cantidad < 500):
                        $saldo_regalado = $cantidad * 0.01;
                        break;

                    case ($cantidad >= 500 && $cantidad < 999):
                        $saldo_regalado = $cantidad * 0.02;
                        break;

                    case ($cantidad >= 1000 && $cantidad < 5000):
                        $saldo_regalado = $cantidad * 0.03;
                        break;
                }
            } else {
                return redirect()->route('saldo.index')->with('error', 'Error al realizar la compra.');
            }
        }

        // Stripe\Stripe::setApiKey("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");

        $cantidad_iva = $cantidad * 1.21;
        $cantidad_stripe = $cantidad_iva * 100;

        /*$intent = \Stripe\PaymentIntent::create([
            'amount' => $cantidad_stripe,
            'currency' => 'EUR',
            'metadata' => ['integration_check' => 'accept_a_payment', 'email' => $email],
        ]);*/


        /* return view('saldo.comprar', [
            'cantidad' => $cantidad,
            'saldo_regalado' => $saldo_regalado,
            'nombre' => $nombre,
            'email' => $email,
            'client_secret' => $intent->client_secret,
        ]);*/
    }
}
