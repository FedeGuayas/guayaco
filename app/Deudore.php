<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deudore extends Model
{
    protected $table='deudores';
    public $timestamps=false;

    protected $fillable=[
        'num_doc','chip'
    ];
}
