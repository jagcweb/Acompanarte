<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Crypt;
use App\Models\Price;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\NotificationController;

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
        $id = \Crypt::decryptString($id);

        $contact_request = ContactRequest::find($id);
        $price = Price::where('type', 'contacto')->first();

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
            'ciudad' => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'string', 'max:255'],
            'acompañamiento' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'alpha_num', 'max:9', 'min:9'],
            'fecha' => ['nullable', 'date'],
            'ensayo' => ['required', 'boolean'],
            'acompañamiento' => ['required', 'string', 'max:255'],
            'pdf' => ['nullable', 'mimes:pdf'],
            
        ]);

        if($request->get('ensayo') == 1){
            $validate = $this->validate($request, [
                'num_ensayo' => ['required', 'alpha_num', 'min:1'],
            ]);
        }

        $pianista_id = \Crypt::decryptString($request->get('pianista_id'));

        do {
            $codigo = \Str::random(12);
        } while (ContactRequest::where('reference', $codigo)->exists());

        $contact_request = new ContactRequest();
        $contact_request->user_id = $pianista_id;
        $contact_request->client_id = Auth::user()->id;
        $contact_request->name = $request->get('nombre');
        $contact_request->location = $request->get('ciudad');
        $contact_request->specialty = $request->get('especialidad');
        $contact_request->accompaniment = $request->get('acompañamiento');
        $contact_request->email = $request->get('email');
        $contact_request->phone = $request->get('telefono');
        $contact_request->accompaniment = $request->get('acompañamiento');
        $contact_request->date_event = $request->get('fecha');
        $contact_request->rehearsals = $request->get('ensayo');
        $contact_request->num_rehearsals = $request->get('num_ensayo');
        $contact_request->reference = $codigo;
        $contact_request->unblocked = 0;

        $pdf = $request->file('pdf');

        if($pdf){
            $pdf_name = time() .'_'. $pdf->getClientOriginalName().'.pdf';

            \Storage::disk('pdfs')->put($pdf_name, \File::get($pdf));

            $contact_request->pdf = $pdf_name;
        }

        $contact_request->save();

        $user = User::find($pianista_id);
        $data = ['user' => $user, 'contact_request' => $contact_request];
        \Mail::send('mail.send_contact_request', $data, function ($message) use($user) {
            $message->from('encuentrapianista@gmail.com', 'EncuentraPianista');
            $message->to($user->email)->subject('Nueva solicitud de contacto');
        });

        app(NotificationController::class)->save($user->id, 'contact', $contact_request->id, 'Solicitud de contacto');

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

                return redirect()->route('contact_request.detail', ['id' => Crypt::encryptString($contact_request->id)])->with('exito', 'Solicitud de contacto pagada');
            }

            return route('home');
        }

        return route('home');
        
    }

    public function accept($id) {
        $id = \Crypt::decryptString($id);

        $contact_request = ContactRequest::find($id);

        if($contact_request){
            $contact_request->accepted = 1;
            $contact_request->updated_at = Carbon::now();
            $contact_request->update();

            $user = $contact_request->client;
            $data = ['contact_request' => $contact_request];
            \Mail::send('mail.accept_contact_request', $data, function ($message) use($user) {
                $message->from('encuentrapianista@gmail.com', 'EncuentraPianista');
                $message->to($user->email)->subject('El pianista ha aceptado su solicitud');
            });

            return back()->with('exito', 'Propuesta aceptada!');
        }

        return back()->with('error', 'Esta propuesta no existe.');
    }

    public function decline($id) {
        $id = \Crypt::decryptString($id);

        $contact_request = ContactRequest::find($id);

        if($contact_request){
            $contact_request->accepted = 0;
            $contact_request->updated_at = Carbon::now();
            $contact_request->update();

            $user = $contact_request->client;
            $data = ['contact_request' => $contact_request];
            \Mail::send('mail.decline_contact_request', $data, function ($message) use($user) {
                $message->from('encuentrapianista@gmail.com', 'EncuentraPianista');
                $message->to($user->email)->subject('El pianista ha rechazado su solicitud');
            });

            return back()->with('exito', 'Propuesta rechazada!');
        }

        return back()->with('error', 'Esta propuesta no existe.');
    }

    public function getPdf($filename) {
        $file = \Storage::disk('pdfs')->get($filename);

        return new Response($file, 200);
    }

}
