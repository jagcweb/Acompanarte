<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfigurationProfessor;

class ConfigurationProfessorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $comunidades = PostalCode::select('comunidad_autonoma')->groupBy('comunidad_autonoma')->orderBy('comunidad_autonoma', 'asc')->get();

        return view('professor_config.index', [
            'comunidades' => $comunidades,
        ]);
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'disponibilidad' => ['required', 'string', 'max:255'],
        ]);

        switch($request->get('disponibilidad')){
            case('comunidad'):
                $validate = $this->validate($request, [
                    'comunidad' => ['required', 'string', 'max:255'],
                ]);
            break;

            case('provincia'):
                $validate = $this->validate($request, [
                    'comunidad' => ['required', 'string', 'max:255'],
                    'provincia' => ['required', 'string', 'max:255'],
                ]);
            break;

            case('poblacion'):
                $validate = $this->validate($request, [
                    'comunidad' => ['required', 'string', 'max:255'],
                    'provincia' => ['required', 'string', 'max:255'],
                    'poblacion' => ['required', 'string', 'max:255'],
                ]);
            break;
        }

        $config = new ConfigurationProfessor();
        $config->user_id = Auth::user()->id;
        $config->availability = $request->get('disponibilidad');
        $config->community = $request->get('comunidad');
        $config->province = $request->get('provincia');
        $config->city = $request->get('poblacion');
        $config->save();

        return back()->with('exito', 'Configuración guardada');


    }

    public function getProvinces($community)
    {
        $provincias = PostalCode::select('provincia')->where('comunidad_autonoma', $community)->groupBy('provincia')->orderBy('provincia', 'asc')->get();

        if(count($provincias)>0){
            $status = 200;
            return response(json_encode($provincias), $status)->header('Content-type', 'text/plain');
        }

        $status = 404;
        return response(json_encode('error'),$status);
    }

    public function getCity($province)
    {
        $poblaciones = PostalCode::select('poblacion')->where('provincia', $province)->groupBy('poblacion')->orderBy('poblacion', 'asc')->get();

        if(count($poblaciones)>0){
            $status = 200;
            return response(json_encode($poblaciones), $status)->header('Content-type', 'text/plain');
        }

        $status = 404;
        return response(json_encode('error'),$status);
    }
}
