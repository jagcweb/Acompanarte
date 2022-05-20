<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ProfessorSuscription;
use App\Models\ProfessorSuscriptionHistory;
use Carbon\Carbon;

class CheckSuscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $suscription_history = new ProfessorSuscriptionHistory();
        $suscription_history->user_id = 13;
        $suscription_history->type = 'trimestral';
        $suscription_history->pdf = 'test.pdf';
        $suscription_history->ended_at = Carbon::now()->addMonth(3);
        $suscription_history->save();
        /*$suscriptions = ProfessorSuscription::where('ended_at', Carbon::now()->format('Y-m-d'))->get();

        if(count($suscriptions) > 0){
            foreach($suscriptions as $sus){
                if($sus->auto_renew == 1){
                    switch ($sus->type) {
                        case 'trimestral':
                            $new_ended_day = Carbon::now()->addMonth(3);
                            break;
                        
                        case 'anual':
                            $new_ended_day = Carbon::now()->addYear(1);
                            break;
                        
                        default:
                    }

                    $sus->updated_at = Carbon::now();
                    $sus->ended_at = $new_ended_day;
                    $sus->update();

                    $suscription_history = new ProfessorSuscriptionHistory();
                    $suscription_history->user_id = $sus->user_id;
                    $suscription_history->type = $type;
                    $suscription_history->pdf = 'test.pdf';
                    $suscription_history->ended_at = $ended_at;
                    $suscription_history->save();
                }else{
                    $sus->user->removeRole('pianista-premium');
                    $sus->user->assignRole('pianista');
                    $sus->delete();
                }
            }
        }*/
    }
}
