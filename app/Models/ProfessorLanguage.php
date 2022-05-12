<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorLanguage extends Model
{
    protected $table = 'professor_languages';
    protected $fillable = [
        'user_id',
        'language',
        'level'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
