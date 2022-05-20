<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_requests';
    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'phone',
        'accompaniment',
        'date_event',
        'rehearsals',
        'num_rehearsals',
        'price',
        'unblocked',
    ];

    public function unblock(){
    	return $this->hasOne(ContactRequestUnblock::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function client(){
    	return $this->belongsTo(User::class);
    }
}
