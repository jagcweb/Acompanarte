<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessorSuscription;
use App\Models\ProfessorSuscriptionHistory;
use Carbon\Carbon;
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
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        CheckSuscription::dispatch()->onQueue('processing');
    }
}