<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationProfessor extends Model
{
    protected $table = 'configuration_professors';
    protected $fillable = [
        'user_id',
        'availability',
        'community',
        'province',
        'city',
        'biography',
        'languages',
        'essay_place',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
