<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorAccompaniment extends Model
{
    protected $table = 'professor_accompaniments';
    protected $fillable = [
        'user_id',
        'accompaniment'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
