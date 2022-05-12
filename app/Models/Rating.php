<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = [
        'user_id',
        'client_id',
        'rate',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function client(){
    	return $this->belongsTo(User::class);
    }
}
