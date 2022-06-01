<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index($rol)
    {
        return view('auth.register', [
            'rol' => $rol
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        //Ejemplo previous url: registrar-cliente.
        //Explodeamos por "-" y sacamos el rol de la posicion 1 (cliente)
        $role = explode("/", url()->previous())[4];

        $phone_field = $role != 'cliente' ? 'required' : 'nullable';

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => [$phone_field, 'alpha_num', 'min:9', 'max:9'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        do {
            $codigo = \Str::random(12);
        } while (User::where('username', $codigo)->exists());

        $username = $role != 'cliente' ? $codigo : null;

        $created_user = User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'phone' => isset($request['phone']) ? $request['phone'] : NULL,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'username' => $username,
            'visits' => 0,
        ]);

        $created_user->assignRole($role);

        $created_user->sendEmailVerificationNotification();

        return redirect()->route('home')->with('exito', 'Se ha registrado correctamente. Antes de hacer login debe confirmar el email.');
    }
}
