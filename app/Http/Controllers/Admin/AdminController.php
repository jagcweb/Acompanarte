<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfessorSuscriptionHistory;

class AdminController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->getRoleNames()[0] == 'administrador'){
            return view('admin.index');
        }

        return redirect()->route('home');
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
}
