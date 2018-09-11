<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuito extends Model
{
    
	protected $table='circuitos';
	protected $primaryKey='id';
	public $timestamps=false;

	//Campos k se guardaran en la bd
	protected $fillable=[
		'circuito'
	];

	public function inscripciones()
	{
		return $this->hasMany(Inscripcion::class);
	}
}
