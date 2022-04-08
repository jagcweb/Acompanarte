<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConfigurationPremiumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('professor_premium.index');
    }

    public function premium()
    {
        $user = Auth::user();
        $user->updated_at = Carbon::now();
        $user->update();
        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole('profesor-premium');

        return back()->with('exito', 'Enhorabuena! Ahora eres un usuario premium');
    }

    public function free()
    {
        $user = Auth::user();
        $user->updated_at = Carbon::now();
        $user->update();
        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole('profesor');

        return back()->with('exito', 'Ahora eres un usuario free');
    }
}
