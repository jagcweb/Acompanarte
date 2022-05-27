<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactRequest;
use App\Models\ProfessorSuscriptionHistory;
use App\Models\Price;
use App\Models\SearchHistory;
use App\Models\PostalCode;

class AdminController extends Controller
{
    public function index(){
        if(!Auth::check() || Auth::user()->getRoleNames()[0] != 'administrador'){
            return redirect()->route('home');
        }

        $clientes = User::whereHas(
            'roles', function($q){
                $q->where('name', 'cliente');
            }
        )
        ->count();

        $pianistas = User::whereHas(
            'roles', function($q){
                $q->where('name', 'pianista');
            }
        )
        ->count();

        $premiums = User::whereHas(
            'roles', function($q){
                $q->where('name', 'pianista-premium');
            }
        )
        ->count();

        $premiums_verified = User::whereHas(
            'roles', function($q){
                $q->where('name', 'pianista-premium');
            }
        )
        ->whereNotNull('verified')
        ->count();

        $contact_requests = ContactRequest::count();

        $comunidades =  PostalCode::select('comunidad_autonoma')->groupBy('comunidad_autonoma')->orderBy('comunidad_autonoma', 'asc')->get();

        return view('admin.index', [
            'clientes' => $clientes,
            'premiums' => $premiums,
            'premiums_verified' => $premiums_verified,
            'pianistas' => $pianistas,
            'contact_requests' => $contact_requests,
            'comunidades' => $comunidades,
        ]);
    }

    public function users(){

        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', '!=', 'administrador');
            }
        )->orderBy('id', 'desc')->paginate(20);
        
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function history(){

        $histories = ProfessorSuscriptionHistory::orderBy('id', 'desc')->paginate(20);
        
        return view('admin.history.index', [
            'histories' => $histories
        ]);
    }

    public function search_history(){

        $search_history = SearchHistory::orderBy('id', 'asc')->get();
        
        return view('admin.search_history.index', [
            'search_history' => $search_history
        ]);
    }

    public function price(){

        $prices = Price::orderBy('id', 'asc')->get();
        
        return view('admin.price.index', [
            'prices' => $prices
        ]);
    }
}
