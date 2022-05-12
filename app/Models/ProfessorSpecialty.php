<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorSpecialty extends Model
{
    protected $table = 'professor_specialties';
    protected $fillable = [
        'user_id',
        'specialty'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
