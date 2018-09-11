<?php

namespace App;



use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps=true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rols_id',
        'escenario_id',
        'name',
        'email',
        'password',
        'nombre',
        'avatar',
        'estado',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates=['deleted_at'];

    //al actualizar un registro, prevenir que Laravel grabe una contraseña vacía y encriptar las contraseñas no vacías
    /*get[nombre del atributo en camelCase]Attribute  *******   set[nombre del atributo en camelCase]Attribute*/
    /*public function getPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    // se imprimirán siempre en mayúsculas los nombres de usuario
    public function getNombreAttribute()
    {
        return strtoupper($this->attributes['nombre']);
    }
*/

    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }


    //relaciones
    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    public function escenario(){
        return $this->belongsTo(Escenario::class);
    }

    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }

    /**
     * Obtener las inscripciones de esta entrada del usuario
     * $inscripciones=App\User::find($id)->inscripcion;
     * */
    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }
    

}

