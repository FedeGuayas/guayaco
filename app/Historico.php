<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'num_doc',
        'nombres',
        'apellidos',
        'fecha_nac',
        'sex',
        'email',
        'direccion',
        'telefono',
        'category',
        'circuit',
        'chip',
        'place',
        'time',
        'year',
        'costo',
    ];

}
