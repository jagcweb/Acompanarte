<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['profile', 'getImage']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.index');
    }

    public function profile($username)
    {
        $user = User::where('username', $username)->first();

        if(!$user){
            return redirect()->route('home')->with('error', 'El usuario no existe');
        }

        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            //'image' => ['nullable', 'image']
        ]);

        $image = $request->file('image');

        if($image){
            $image_name = time() .'_'. $image->getClientOriginalName();

            if (!is_null($user->image)) {
                \Storage::disk('profile_images')->delete($user->image);
            }

            \Storage::disk('profile_images')->put($image_name, \File::get($image));

            $user->image = $image_name;
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->updated_at = Carbon::now();
        $user->update();

        return back()->with('exito', 'Perfil actualizado!');
    }

    public function updatePassword(Request $request){
        $user = Auth::user();

        $validate = $this->validate($request, [
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $current_password = $request->get('current_password');
        $new_password = $request->get('password');

        if(!Hash::check($current_password, Auth::user()->password)){
            return back()->with('error', 'La contraseña introducida no coindice con la actual');
        }

        if(Hash::check($new_password, Auth::user()->password)){
            return back()->with('error', 'La contraseña introducida no puede ser la misma que la actual');
        }

        $user->password = Hash::make($new_password);
        $user->updated_at = Carbon::now();
        $user->update();

        return back()->with('exito', 'Contraseña actualizada!');
    }

    public function getImage($filename) {
        $file = Storage::disk('profile_images')->get($filename);

        return new Response($file, 200);
    }
}
