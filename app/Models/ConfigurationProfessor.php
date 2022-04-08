<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationProfessor extends Model
{
    protected $table = 'configuration_professor';
    protected $fillable = [
        'availability',
        'community',
        'province',
        'city'
    ];

    public function user(){
    	return $this->hasOne(User::class);
    }
}
