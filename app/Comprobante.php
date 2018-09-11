<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected  $table='comprobantes';
    protected $primaryKey='id';
    public  $timestamps=true;

    protected  $fillable=[
        'user_id',
        'inscripcion_id',
        'cuenta_id',
        'nombres',
        'apellidos',
        'num_doc',
        'telefono',
        'email',
        'direccion',
    ];

    public function inscripcion(){
        return $this->belongsTo(Inscripcion::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }

}


