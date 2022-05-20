<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfigurationProfessor;
use App\Models\ProfessorSpecialty;
use App\Models\ProfessorAccompaniment;
use App\Models\ProfessorLanguage;

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
            'especialidad' => ['required', 'array', 'max:255'],
            'formacion' => ['required', 'string', 'max:255'],
            'precio' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,1})?$/'],
            'otros' => ['nullable', 'array', 'max:255'],
            'idiomas' => ['nullable', 'array', 'max:255'],
            'acompañamiento' => ['required', 'array', 'max:255'],
            'nivel' => ['nullable', 'array', 'max:255'],
            'exp' => ['nullable', 'string', 'max:255'],
        ]);

        if(count($request->get('idiomas')) != count($request->get('nivel'))){
            return back()->with('error', 'Debes introducir los mismos idiomas que niveles.');
        }


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
        $config->education = $request->get('formacion');
        $config->other_degrees =  json_encode($request->get('otros'), JSON_FORCE_OBJECT);
        $config->experience = $request->get('exp');
        $config->price = $request->get('precio');
        $config->save();

        foreach ($request->get('especialidad') as $especialidad){
            $specialty = new ProfessorSpecialty();
            $specialty->user_id = Auth::user()->id;
            $specialty->specialty = $especialidad;
            $specialty->save();
        }

        foreach ($request->get('acompañamiento') as $acompañamiento){
            $accompaniment = new ProfessorAccompaniment();
            $accompaniment->user_id = Auth::user()->id;
            $accompaniment->accompaniment = $acompañamiento;
            $accompaniment->save();
        }

        for($i=0; $i < sizeof($request->get('idiomas')); $i++){
            $language = new ProfessorLanguage();
            $language->user_id = Auth::user()->id;
            $language->language = $request->get('idiomas')[$i];
            $language->level = $request->get('nivel')[$i];
            $language->save();
        }

        return back()->with('exito', 'Configuración guardada');


    }

    public function update(Request $request)
    {
        $validate = $this->validate($request, [
            'disponibilidad' => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'array', 'max:255'],
            'formacion' => ['required', 'string', 'max:255'],
            'precio' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,1})?$/'],
            'acompañamiento' => ['required', 'array', 'max:255'],
            'otros' => ['nullable', 'array', 'max:255'],
            'idiomas' => ['nullable', 'array', 'max:255'],
            'nivel' => ['nullable', 'array', 'max:255'],
            'exp' => ['nullable', 'string', 'max:255'],
        ]);

        if(count($request->get('idiomas')) != count($request->get('nivel'))){
            return back()->with('error', 'Debes introducir los mismos idiomas que niveles.');
        }


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

        $config = ConfigurationProfessor::where('user_id', Auth::user()->id)->first();
        $config->user_id = Auth::user()->id;
        $config->availability = $request->get('disponibilidad');
        $config->community = $request->get('comunidad');
        $config->province = $request->get('provincia');
        $config->city = $request->get('poblacion');
        $config->education = $request->get('formacion');
        $config->other_degrees =  json_encode($request->get('otros'), JSON_FORCE_OBJECT);
        $config->experience = $request->get('exp');
        $config->price = $request->get('precio');
        $config->update();

        $especialties = ProfessorSpecialty::where('user_id', Auth::user()->id)->delete();
        foreach ($request->get('especialidad') as $especialidad){

            $specialty = new ProfessorSpecialty();
            $specialty->user_id = Auth::user()->id;
            $specialty->specialty = $especialidad;
            $specialty->save();
        }

        $accompaniments = ProfessorAccompaniment::where('user_id', Auth::user()->id)->delete();
        foreach ($request->get('acompañamiento') as $acompañamiento){

            $accompaniment = new ProfessorAccompaniment();
            $accompaniment->user_id = Auth::user()->id;
            $accompaniment->accompaniment = $acompañamiento;
            $accompaniment->save();
        }

        $languages = ProfessorLanguage::where('user_id', Auth::user()->id)->delete();
        for($i=0; $i < sizeof($request->get('idiomas')); $i++){

            $language = new ProfessorLanguage();
            $language->user_id = Auth::user()->id;
            $language->language = $request->get('idiomas')[$i];
            $language->level = $request->get('nivel')[$i];
            $language->save();
        }

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
