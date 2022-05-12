<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorSuscriptionHistory extends Model
{
    protected $table = 'professor_suscriptions_history';
    protected $fillable = [
        'user_id',
        'type',
        'ended_at',
        'pdf',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
