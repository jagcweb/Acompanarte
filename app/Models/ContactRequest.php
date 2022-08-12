<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_requests';
    protected $fillable = [
        'user_id',
        'client_id',
        'reference',
        'name',
        'location',
        'specialty',
        'accompaniment',
        'phone',
        'accompaniment',
        'date_event',
        'rehearsals',
        'num_rehearsals',
        'price',
        'unblocked',
        'pdf',
        'accepted',
        'code',
        'pdf_invoice'
    ];

    public function unblock(){
    	return $this->hasOne(ContactRequestUnblock::class);
    }

    public function repertoire(){
    	return $this->hasMany(ContactRequestsRepertoire::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function client(){
    	return $this->belongsTo(User::class);
    }
}
