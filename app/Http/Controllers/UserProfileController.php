<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Validate;
use App\User;
use \Crypt;

class UserProfileController extends Controller
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
        return view('userprofile.index');
    }

    public function update(Request $request){
        
        $id = Crypt::decryptString($request->get('id'));

        $validate = $this->validate($request, [
            'id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);
    }
}
