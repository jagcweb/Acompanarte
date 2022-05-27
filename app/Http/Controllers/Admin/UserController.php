<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfessorSuscriptionHistory;

class UserController extends Controller
{
    public function delete($id){
        $user = User::find($id);

        if($user){
            \App\Models\ConfigurationProfessor::where('user_id', $user->id)->delete();
            \App\Models\ProfessorAccompaniment::where('user_id', $user->id)->delete();
            \App\Models\ProfessorLanguage::where('user_id', $user->id)->delete();
            \App\Models\ProfessorSpecialty::where('user_id', $user->id)->delete();
            \App\Models\ProfessorSuscription::where('user_id', $user->id)->delete();
            $user->delete();
        }else{
            return back();
        }


        return back()->with('exito', 'El usuario ha sido eliminado');
    }

    public function change_rol_pianista($id){
        $user = User::find($id);

        if($user){
            $user->removeRole($user->getRoleNames()[0]);
            $user->assignRole('pianista');
            $user->update();
        }else{
            return back();
        }


        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido degradado a Pianista.');
    }

    public function change_rol_premium($id){
        $user = User::find($id);

        if($user){
            $user->removeRole($user->getRoleNames()[0]);
            $user->assignRole('pianista-premium');
            $user->update();
        }else{
            return back();
        }

        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido ascentido a Pianista Premium.');
    }

    public function ban($id){
        $user = User::find($id);

        if($user){
            $user->banned = 1;
            $user->update();
        }else{
            return back();
        }

        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido baneado.');
    }

    public function unban($id){
        $user = User::find($id);

        if($user){
            $user->banned = null;
            $user->update();
        }else{
            return back();
        }

        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido desbaneado.');
    }

    public function verify($id){
        $user = User::find($id);

        if($user){
            $user->verified = 1;
            $user->update();
        }else{
            return back();
        }

        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido verificado.');
    }

    public function unverify($id){
        $user = User::find($id);

        if($user){
            $user->verified = null;
            $user->update();
        }else{
            return back();
        }

        return back()->with('exito', 'El usuario '. $user->fullname . ' con email ' . $user->email . ' ha sido desverificado.');
    }

}
