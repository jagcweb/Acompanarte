<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'work';
    protected $fillable = [
        'id',
        'name',
        'type',
        'parent',
        'composer',
        'title',
        'icatno',
        'pageid',
        'link'

    ];
}
