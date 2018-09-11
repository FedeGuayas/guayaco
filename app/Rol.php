<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected  $table='rols';
    protected $primaryKey='id';
    public  $timestamps=false;

    protected  $fillable=[
        'rol',
    ];

    //relaciones
    public function users(){
        return $this->hasMany(User::class);
    }

}
