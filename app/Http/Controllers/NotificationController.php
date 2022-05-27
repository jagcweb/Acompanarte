<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function delete($id){
        $id = \Crypt::decryptString($id);
        $notif = Notification::find($id);

        if($notif){
            $notif->delete();

            return back()->with('exito', 'Notificación borrada!');
        }

        return back()->with('error', 'La notificación no ha podido ser borrada o no existe.');
    }

    public function deleteAll(){

        $notifis = Notification::where('user_id', Auth::user()->id)->get();

        if(count($notifis)>0){

            foreach($notifis as $notif){
                $notif->delete();
            }

            return back()->with('exito', 'Todas las notificaciones borradas!');
        }

        return back()->with('error', 'Error al borrar las notificaciones.');

    }

    public function markAsRead($id){
        $id = \Crypt::decryptString($id);
        $notif = Notification::find($id);

        if($notif){
            $notif->read = 1;
            $notif->update();
            switch($notif->type){
                case('contact'):
                    return redirect()->route('contact_request.detail', ['id' => \Crypt::encryptString($notif->type_id)]);
                break;
            }
        }
        return back()->with('error', 'La notificación no existe.');
    }

    public function save(int $user_id, string $type, int $type_id, string $text){
        $notif = new Notification();
        $notif->user_id = $user_id;
        $notif->type = $type;
        $notif->type_id = $type_id;
        $notif->text = $text;
        $notif->read = 0;
        $notif->save();
    }
}
