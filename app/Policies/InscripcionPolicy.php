<?php

namespace App\Policies;

use App\Inscripcion;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InscripcionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Inscripcion $inscripcion){
        if  (($user->rols_id==1) || ($user->id==$inscripcion->user_id))
        return true  ;
    }

    public function delete(User $user, Inscripcion $inscripcion){
        if  (($user->rols_id==1) || ($user->id==$inscripcion->user_id))
            return true  ;
    }
}
