<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfigurationProfessor;
use App\Models\ProfessorSpecialty;
use App\Models\ProfessorAccompaniment;
use App\Models\ProfessorLanguage;
use App\Models\ProfessorLocation;


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
            'disponibilidad' => ['required'],
            'disponibilidad.*' => ['required','string'],
            'especialidad' => ['required', 'array', 'max:255'],
            'formacion' => ['required', 'string', 'max:255'],
            'precio' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,1})?$/'],
            'biography' => ['nullable', 'string'],
            'idiomas' => ['nullable', 'array', 'max:255'],
            'acompañamiento' => ['required', 'array', 'max:255'],
            'nivel' => ['nullable', 'array', 'max:255'],
            'lugar' => ['nullable', 'alpha_num', 'max:1'],
        ]);


        foreach ($request->get('disponibilidad') as $i=>$dispo){
    
            switch($dispo){
                case('Comunidad Autónoma'):
                    $validate = $this->validate($request, [
                        'comunidad_'.$i => ['required','string'],
                    ]);
                break;
    
                case('Provincial'):
                    $validate = $this->validate($request, [
                        'comunidad_'.$i => ['required','string'],
                        'provincia_'.$i => ['required','string'],
                    ]);
                break;
    
                case('Población'):
                    $validate = $this->validate($request, [
                        'comunidad_'.$i => ['required','string'],
                        'provincia_'.$i => ['required', 'string'],
                        'poblacion_'.$i => ['required','string'],
                    ]);
                break;
            }
        }

        if(!is_null($request->get('idiomas')) && !is_null($request->get('nivel'))){
            if(count($request->get('idiomas')) != count($request->get('nivel'))){
                return back()->with('error', 'Debes introducir los mismos idiomas que niveles.');
            }

            for($i=0; $i < sizeof($request->get('idiomas')); $i++){
                $language = new ProfessorLanguage();
                $language->user_id = Auth::user()->id;
                $language->language = $request->get('idiomas')[$i];
                $language->level = $request->get('nivel')[$i];
                $language->save();
            }
        }


        $config = new ConfigurationProfessor();
        $config->user_id = Auth::user()->id;
        $config->education = $request->get('formacion');
        $config->biography = $request->get('biography');
        $config->price = $request->get('precio');
        $config->essay_place = $request->get('lugar');
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

       foreach ($request->get('disponibilidad') as $i=>$dispo){
            $location = new ProfessorLocation();
            $location->user_id = Auth::user()->id;
            $location->availability = $dispo;
            switch($dispo){
                case('Nacional'):
                    $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('availability', 'Nacional')->first();
                break;
                case('Comunidad Autónoma'):
                    $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('community', $request->get('comunidad_'.$i))->first();
                    $location->community = $request->get('comunidad_'.$i);
                break;
    
                case('Provincial'):
                    $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('province', $request->get('provincia_'.$i))->first();
                    $location->community = $request->get('comunidad_'.$i);
                    $location->province = $request->get('provincia_'.$i);
                break;
    
                case('Población'):
                    $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('city', $request->get('poblacion_'.$i))->first();
                    $location->community = $request->get('comunidad_'.$i);
                    $location->province = $request->get('provincia_'.$i);
                    $location->city = $request->get('poblacion_'.$i);
                break;
            }

            if(!is_object($exist_location)){
                $location->save();
            }
        }

        return back()->with('exito', 'Configuración guardada');


    }

    public function update(Request $request)
    {
        $validate = $this->validate($request, [
            'disponibilidad' => ['nullable'],
            'disponibilidad.*' => ['nullable','string'],
            'especialidad' => ['required', 'array', 'max:255'],
            'formacion' => ['required', 'string', 'max:255'],
            'precio' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,1})?$/'],
            'acompañamiento' => ['required', 'array', 'max:255'],
            'biography' => ['nullable', 'string'],
            'idiomas' => ['nullable', 'array', 'max:255'],
            'nivel' => ['nullable', 'array', 'max:255'],
            'lugar' => ['nullable', 'alpha_num', 'max:1'],
        ]);

        if(!is_null($request->get('disponibilidad'))){

            foreach ($request->get('disponibilidad') as $i=>$dispo){
        
                switch($dispo){
                    case('Comunidad Autónoma'):
                        $validate = $this->validate($request, [
                            'comunidad_'.$i => ['required','string'],
                        ]);
                    break;
        
                    case('Provincial'):
                        $validate = $this->validate($request, [
                            'comunidad_'.$i => ['required','string'],
                            'provincia_'.$i => ['required','string'],
                        ]);
                    break;
        
                    case('Población'):
                        $validate = $this->validate($request, [
                            'comunidad_'.$i => ['required','string'],
                            'provincia_'.$i => ['required', 'string'],
                            'poblacion_'.$i => ['required','string'],
                        ]);
                    break;
                }
            }
        }

        if(!is_null($request->get('idiomas')) && !is_null($request->get('nivel'))){
            if(count($request->get('idiomas')) != count($request->get('nivel'))){
                return back()->with('error', 'Debes introducir los mismos idiomas que niveles.');
            }

            $languages = ProfessorLanguage::where('user_id', Auth::user()->id)->delete();
            for($i=0; $i < sizeof($request->get('idiomas')); $i++){
    
                $language = new ProfessorLanguage();
                $language->user_id = Auth::user()->id;
                $language->language = $request->get('idiomas')[$i];
                $language->level = $request->get('nivel')[$i];
                $language->save();
            }
    
        }

        $config = ConfigurationProfessor::where('user_id', Auth::user()->id)->first();
        $config->user_id = Auth::user()->id;
        $config->education = $request->get('formacion');
        $config->biography = $request->get('biography');
        $config->price = $request->get('precio');
        $config->essay_place = $request->get('lugar');
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

        if(!is_null($request->get('disponibilidad'))){
            foreach ($request->get('disponibilidad') as $i=>$dispo){
                $location = new ProfessorLocation();
                $location->user_id = Auth::user()->id;
                $location->availability = $dispo;
                switch($dispo){
                    case('Nacional'):
                        $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('availability', 'Nacional')->first();
                    break;
                    case('Comunidad Autónoma'):
                        $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('community', $request->get('comunidad_'.$i))->first();
                        $location->community = $request->get('comunidad_'.$i);
                    break;
        
                    case('Provincial'):
                        $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('province', $request->get('provincia_'.$i))->first();
                        $location->community = $request->get('comunidad_'.$i);
                        $location->province = $request->get('provincia_'.$i);
                    break;
        
                    case('Población'):
                        $exist_location = ProfessorLocation::where('user_id', Auth::user()->id)->where('city', $request->get('poblacion_'.$i))->first();
                        $location->community = $request->get('comunidad_'.$i);
                        $location->province = $request->get('provincia_'.$i);
                        $location->city = $request->get('poblacion_'.$i);
                    break;
                }

                if(!is_object($exist_location)){
                    $location->save();
                }
            }
        }

        return back()->with('exito', 'Configuración guardada');


    }

    public function deleteLocation($id){
        $id = \Crypt::decryptString($id);
        $location = ProfessorLocation::find($id);

        if($location){
            $location->delete();

            return back()->with('exito', 'Localización borrada');
        }

        return back()->with('error', 'La localización no existe!');
    }

    public function getCommunities()
    {
        $comunidades = PostalCode::select('comunidad_autonoma')->groupBy('comunidad_autonoma')->orderBy('comunidad_autonoma', 'asc')->get();

        if(count($comunidades)>0){
            $status = 200;
            return response(json_encode($comunidades), $status)->header('Content-type', 'text/plain');
        }

        $status = 404;
        return response(json_encode('error'),$status);
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
