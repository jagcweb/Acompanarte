<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'people';
    protected $fillable = [
        'id',
        'name',
        'type',
        'parent',
        'link'

    ];
}
