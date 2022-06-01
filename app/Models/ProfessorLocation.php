<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorLocation extends Model
{
    protected $table = 'professor_locations';
    protected $fillable = [
        'user_id',
        'availability',
        'community',
        'province',
        'city',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
