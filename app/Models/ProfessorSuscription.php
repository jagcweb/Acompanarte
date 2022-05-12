<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorSuscription extends Model
{
    protected $table = 'professor_suscriptions';
    protected $fillable = [
        'user_id',
        'type',
        'auto_renew',
        'ended_at'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
