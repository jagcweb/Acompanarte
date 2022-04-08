<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $fillable = [
        'ISO',
        'Country',
        'Language',
        'renferia',
        'codigo_postal',
        'comunidad_autonoma',
        'provincia',
        'poblacion',
        'localidad',
        'lat',
        'lon',
        'elevation',
        'TimeZone',
        'UTC',
        'DST',
        'ID_2'
    ];
}
