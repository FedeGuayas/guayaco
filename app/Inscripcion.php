<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Inscripcion extends Model
{
    protected $table='inscripciones';
    protected $primaryKey='id';
    public $timestamps=true;

    protected $fillable=[
        'persona_id',
        'user_id',
        'categoria_id',
        'circuito_id',
        'deporte_id',
        'fecha_insc',
        'edad',
        'kit',
        'talla',
        'escenario',
        'recomendado',
        'costo',
        'num_corredor',
        'form_pago',
        
    ];

    protected $guarded = [

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function circuito(){
        return $this->belongsTo(Circuito::class);
    }

    public function deporte(){
        return $this->belongsTo(Deporte::class);
    }

    public function comprobante(){
        return $this->hasOne(Comprobante::class);
    }

        
}

