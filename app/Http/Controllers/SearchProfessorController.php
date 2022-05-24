<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostalCode;
use App\Models\ConfigurationProfessor;
use App\Models\User;
use App\Models\SearchHistory;
use Spatie\Permission\Models\Role;

class SearchProfessorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('index', 'getLocation');
    }


    public function index(Request $request)
    {
        $validate = $this->validate($request, [
            'location' => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'string', 'max:255'],
            'acompañamiento' => ['required', 'string', 'max:255']
        ]);

        $location = $request->get('location');
        $especialidad = $request->get('especialidad');
        $acompañamiento = $request->get('acompañamiento');

        $location_data = PostalCode::where('poblacion', $location)->first();

        if(!is_object($location_data)){
            return back()->with('error', 'La ciudad introducida no existe en nuestro registros.');
        }

        $professors = User::
        whereHas('config_professor', function($q) use($location, $location_data) {
            $q->where('availability', 'nacional');
            $q->orWhere('community', $location_data->comunidad_autonoma);
            $q->orWhere('province', $location_data->provincia);
            $q->orWhere('city', $location);
        }
        )
        ->whereHas('professor_specialties', function($q) use($especialidad) {
            $q->where('specialty', $especialidad);
        }
        )
        ->whereHas('professor_accompaniments', function($q) use($acompañamiento) {
            $q->where('accompaniment', $acompañamiento);
        }
        )
        ->whereHas('roles', function($q) {
            $q->orderBy('name', 'desc');
        }
        )
        ->orderBy('id', 'desc')
        ->get();

        $search_history = new SearchHistory();
        $search_history->user_id = Auth::check() ? Auth::user()->id : null;
        $search_history->location = $location;
        $search_history->specialty = $especialidad;
        $search_history->accompaniment = $acompañamiento;
        $search_history->save();

        return view('search_professor.index', [
            'professors' => $professors,
            'location' => $location,
            'especialidad' => $especialidad,
            'acompañamiento' => $acompañamiento
        ]);
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
