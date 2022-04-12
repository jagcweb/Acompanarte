<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostalCode;

class SearchProfessorController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('search_professor.index');
    }

    public function getLocation($value){
        $location = PostalCode::select('poblacion')->where('poblacion', 'LIKE', "%$value%")->groupBy('poblacion')->orderBy('poblacion', 'asc')->limit(20)->get();

        if(count($location)>0){
            $status = 200;
            return response(json_encode($location), $status)->header('Content-type', 'text/plain');
        }

        $status = 404;
        return response(json_encode('error'),$status);
    }
}
