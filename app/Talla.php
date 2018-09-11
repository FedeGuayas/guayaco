<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    const TALLA_DISPONIBLE = 'disponible';
    const TALLA_NO_DISPONIBLE = 'agotado';

    public $timestamps = false;

    protected $fillable = [
        'talla',
        'stock',
        'status',
    ];

    public function estaDisponible()
    {
        return $this->status = Talla::TALLA_DISPONIBLE;
    }
    public function noEstaDisponible()
    {
        return $this->status = Talla::TALLA_NO_DISPONIBLE;
    }


}
