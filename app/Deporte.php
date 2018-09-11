<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    protected $table = 'deportes';
    protected $primaryKey = 'id';
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deporte',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }
    
}
