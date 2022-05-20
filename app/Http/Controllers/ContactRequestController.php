<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Crypt;
use App\Models\Price;
use Carbon\Carbon;

class ContactRequestController extends Controller
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
        if(Auth::user()->getRoleNames()[0] == "cliente"){
            $contact_requests = ContactRequest::where('client_id', Auth::user()->id)->get();
        }else{
            $contact_requests = ContactRequest::where('user_id', Auth::user()->id)->get();
        }

        return view('contact_request.index', [
            'contact_requests' => $contact_requests
        ]);
    }

    public function detail($id)
    {
        $contact_request = ContactRequest::find($id);
        $price = Price::where('type', 'contacto')->first();

        if($contact_request->user_id != Auth::user()->id && $contact_request->client_id != Auth::user()->id){
            return back();
        }

        if(!is_object($contact_request)){
            return back();
        }

        return view('contact_request.detail', [
            'contact_request' => $contact_request,
            'price' => $price,
        ]);
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'pianista_id' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'alpha_num', 'max:9', 'min:9'],
            'fecha' => ['nullable', 'date'],
            'ensayo' => ['required', 'boolean'],
            'mensaje' => ['nullable', 'string'],
            'acompañamiento' => ['required', 'string', 'max:255'],
            
        ]);

        if($request->get('ensayo') == 1){
            $validate = $this->validate($request, [
                'num_ensayo' => ['required', 'alpha_num', 'min:1'],
            ]);
        }

        var_dump($current_price);
        die();

        $contact_request = new ContactRequest();
        $contact_request->user_id = \Crypt::decryptString($request->get('pianista_id'));
        $contact_request->client_id = Auth::user()->id;
        $contact_request->name = $request->get('nombre');
        $contact_request->email = $request->get('email');
        $contact_request->phone = $request->get('telefono');
        $contact_request->accompaniment = $request->get('acompañamiento');
        $contact_request->date_event = $request->get('fecha');
        $contact_request->rehearsals = $request->get('ensayo');
        $contact_request->num_rehearsals = $request->get('num_ensayo');
        $contact_request->unblocked = 0;
        $contact_request->save();

        return redirect()->route('home')->with('exito', 'Solicitud de contacto enviada!');
        
    }

    public function update($cont_id)
    {
        if(isset($cont_id)){
            $cont_id = \Crypt::decryptString($cont_id);
            $contact_request = ContactRequest::find($cont_id);

            $price = Price::where('type', 'contacto')->first();

            if($contact_request){
                $contact_request->unblocked = 1;
                $contact_request->price = !is_null($price->discount) ? $price->price - ($price->price * $price->discount / 100) : $price->price;
                $contact_request->updated_at = Carbon::now();
                $contact_request->update();

                return redirect()->route('contact_request.detail', ['id' => $contact_request->id])->with('exito', 'Solicitud de contacto pagada');
            }

            return route('home');
        }

        return route('home');
        
    }

}
