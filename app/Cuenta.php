<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable=[
        'descripcion',
        'cuenta',
    ];

    protected $guarded = [

    ];

    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }

}
