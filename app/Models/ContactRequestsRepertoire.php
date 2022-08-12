<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_requests_repertoires';
    protected $fillable = [
        'contact_request_id',
        'composer',
        'piece'
    ];

    public function contact_request(){
    	return $this->belongsTo(ContactRequest::class);
    }
}
