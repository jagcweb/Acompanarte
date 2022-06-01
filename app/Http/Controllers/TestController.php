<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CheckSuscription;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $user = \Auth::user();
        $data = ['user' => $user, 'code' => 'holwdwfpdf'];

        \Mail::send('mail.send_invoice', $data, function ($message) use($user) {
            $message->from('admin@encuentrapianista.com', 'EncuentraPianista');
            $message->to('jagc.webdev@gmail.com')->subject('¡Gracias por su compra!');
        }); */
    }
}
