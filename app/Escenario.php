<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{
    protected  $table='escenarios';
    protected $primaryKey='id';
    public  $timestamps=false;

    protected  $fillable=[
        'escenario'
    ];

   //relaciones
    public function users(){
        return $this->hasMany(User::class);
    }
    
}
