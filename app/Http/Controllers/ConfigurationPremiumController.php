<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\ContactRequest;
use App\Models\ProfessorSuscription;
use App\Models\ProfessorSuscriptionHistory;
use App\Models\Price;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Http\Response;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Buyer;


class ConfigurationPremiumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('getInvoice');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $history = ProfessorSuscriptionHistory::where('user_id', Auth::user()->id)->get();

        $quarterly = Price::where('type', 'trimestral')->first();

        $annual = Price::where('type', 'anual')->first();

        return view('professor_premium.index', [
            'history' => $history,
            'quarterly' => $quarterly,
            'annual' => $annual,
        ]);
    }

    public function changeAutoRenew()
    {
        $suscription = ProfessorSuscription::where('user_id', Auth::user()->id)->first();

        if($suscription->auto_renew == 1){
            $suscription->auto_renew = 0;
            $suscription->updated_at = Carbon::now();
            $suscription->update();

            return back()->with('exito', 'Se ha cancelado la auto renovación de su suscripción.');
        }else{
            $suscription->auto_renew = 1;
            $suscription->updated_at = Carbon::now();
            $suscription->update();

            return back()->with('exito', 'Su suscripción se auto renovará el '. Carbon::parse($suscription->ended_at)->format('d/m/Y'));
        }
    }

    public function payment($param)
    {
        if(isset($param)){
            if(!is_null($param)){
                $param = \Crypt::decryptString($param);
                $contact_request = ContactRequest::find($param);
            }
        }else{
            return back();
        }

        $price = Price::where('type', 'contacto')->first();

        $cantidad = !is_null($price->discount) ? $price->price - ($price->price * $price->discount / 100) : $price->price;
        $type = $param;

        Stripe::setApiKey("sk_test_51Kksx2HXud5qSDIw33mrhiEBZOvYYGJQobttbxKWfrkWeSSFb5D11A6BgNVRE8FFHEQtzQYZQZgVvoipSgYFg06A0042HetzO7");

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $cantidad * 100,
            'currency' => 'EUR',
            'metadata' => ['integration_check' => 'accept_a_payment', 'email' => \Auth::user()->email],
        ]);


        return view('professor_premium.payment', [
            'type' => $type,
            'client_secret'=> $intent->client_secret,
            'cantidad'=> $cantidad,
        ]);
    }

    public function payment2($param) //suscripcion
    {
        if(isset($param)){

            if(!is_null($param)){

                switch ($param){
                    case 'trimestral':
                        $price = Price::where('type', 'trimestral')->first();
                        $param = !is_null($price->discount) ? $price->price - ($price->price * $price->discount / 100) : $price->price;
                        break;
                        
                    case 'anual':
                        $price = Price::where('type', 'anual')->first();
                        $param = !is_null($price->discount) ? $price->price - ($price->price * $price->discount / 100) : $price->price;
                        break;

                    default:
                    return back();
                }
            }
        }else{
            return back();
        }

        $cantidad = $param;
        $type = $price->type;

        Stripe::setApiKey("sk_test_51Kksx2HXud5qSDIw33mrhiEBZOvYYGJQobttbxKWfrkWeSSFb5D11A6BgNVRE8FFHEQtzQYZQZgVvoipSgYFg06A0042HetzO7");

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $cantidad * 100,
            'currency' => 'EUR',
            'metadata' => ['integration_check' => 'accept_a_payment', 'email' => \Auth::user()->email],
        ]);


        return view('professor_premium.payment', [
            'client_secret'=> $intent->client_secret,
            'cantidad'=> $cantidad,
            'type' => $type,

        ]);
    }

    public function premium($type, $auto_renew = null)
    {
        $type = \Crypt::decryptString($type);

        $price = Price::where('type', $type)->first();

        $current_price = !is_null($price->discount) ? $price->price - ($price->price * $price->discount / 100) : $price->price;

        switch ($type) {
            case 'trimestral':
                $ended_at = Carbon::now()->addMonth(3);
                break;

            case 'anual':
                $ended_at = Carbon::now()->addYear(1);
                break;
                
            default:
        }

        $suscription = new ProfessorSuscription();
        $suscription->user_id = Auth::user()->id;
        $suscription->type = $type;
        $suscription->price = $current_price;
        $suscription->auto_renew = $auto_renew;
        $suscription->ended_at = $ended_at->format('Y-m-d');
        $suscription->save();

        $last_invoice = ProfessorSuscriptionHistory::orderBy('id', 'desc')->first();

        $code = is_object($last_invoice) ? "AcompañARTE.".explode(".", $last_invoice->code)[1]+1 : "AcompañARTE.1";

        $buyer = new Party([
            'name' => 'gweg',
            'address' => 'ewegew',
            'custom_fields' => [
                'email' => Auth::user()->email
            ],
        ]);

        $customer = new Party([
            'name'          => Auth::user()->fullname,
            'address' => 'ewegew2',
            'custom_fields' => [
                'email' => ''
            ],
        ]);

        $description = 'Suscripción a AcompañARTE desde: '.Carbon::now()->format('d/m/Y'). 'hasta: '.$ended_at->format('d/m/Y');

        $items = [
            (new InvoiceItem())
                ->title('Pago por suscripción')
                ->description($description)
                ->pricePerUnit($price->price)
                ->quantity(1)
                ->discount($price->discount),
        ];

        $notes = [
            "Compra de su suscripción ". ucfirst($type). ' por valor de '.$current_price. '€',
        ];

        $notes = implode($notes);

        $invoice = Invoice::make('FACTURA')
        ->series('#'.$code)
        ->seller($customer)
        ->buyer($buyer)
        ->currencyCode('EUR')
        ->addItems($items)
        ->notes($notes)
        ->filename($code)
        ->totalAmount($current_price)
        ->save('invoices');

        $suscription_history = new ProfessorSuscriptionHistory();
        $suscription_history->user_id = Auth::user()->id;
        $suscription_history->type = $type;
        $suscription_history->code = '#'.$code;
        $suscription_history->price = $current_price;
        $suscription_history->pdf = $code.'.pdf';
        $suscription_history->ended_at = $ended_at->format('Y-m-d');
        $suscription_history->save();

        $user = Auth::user();
        $data = ['user' => $user, 'code' => $code.'.pdf'];

        \Mail::send('mail.send_invoice', $data, function ($message) use($user) {
            $message->from('encuentrapianista@gmail.com', 'EncuentraPianista');
            $message->to($user->email)->subject('¡Gracias por su compra!');
        });

        $user->updated_at = Carbon::now();
        $user->update();
        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole('pianista-premium');

        return redirect()->route('configuration_premium.index')->with('exito', 'Enhorabuena! Ahora eres un usuario premium');
    }

    public function free()
    {
        $user = Auth::user();
        $user->updated_at = Carbon::now();
        $user->update();
        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole('pianista');

        return back()->with('exito', 'Ahora eres un usuario free');
    }

    public function getInvoice($filename) {
        $file = Storage::disk('invoices')->get($filename);

        return new Response($file, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
