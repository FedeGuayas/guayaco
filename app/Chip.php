<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{
    protected $table='chips';
    public $timestamps=false;

    //Campos k se guardaran en la bd
    protected $fillable=[
        'num_doc','chip'
    ];
}
