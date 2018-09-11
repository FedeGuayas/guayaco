<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $timestamps=true;

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_doc',
        'num_doc',
        'genero',
        'fecha_nac',
        'email',
        'direccion',
        'telefono',
        'estado',
        
    ];


    protected $guarded = [
    ];

   
    public function inscripcion(){
        return $this->hasOne(Inscripcion::class);
    }

    //calcular edad
    public function getEdad($fecha_nac) {
        $date = explode('-', $this->$fecha_nac);
        return Carbon::createFromDate($date[0],$date[1],$date[2])->diff(Carbon::now())->format('%y');
        // return Carbon::createFromDate($date[0],$date[1],$date[2])->diff(Carbon::now())->format('%y years %m months %d days');
//        return \Carbon\Carbon::parse($this->fecha_nac)->age;
    }

    
    
}