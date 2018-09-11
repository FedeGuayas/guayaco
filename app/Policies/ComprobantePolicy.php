<?php

namespace App\Policies;

use App\Comprobante;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComprobantePolicy
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

    public function update(User $user, Comprobante $comprobante){
        if  (($user->rols_id==1) || ($user->id==$comprobante->user_id))

        return true;
    }
}
