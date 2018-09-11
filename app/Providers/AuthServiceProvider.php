<?php

namespace App\Providers;

use App\Comprobante;
use App\Inscripcion;
use App\Policies\ComprobantePolicy;
use App\Policies\InscripcionPolicy;
use App\Policies\UsuarioUpdateProfilePolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
//        'App\Inscripcion' => 'App\Policies\InscripcionPolicy',
        Inscripcion::class => InscripcionPolicy::class,
        Comprobante::class => ComprobantePolicy::class,
        User::class => UsuarioUpdateProfilePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

//        $gate->define('inscribir', function($user, $rol){
//            return $user->id===$rol->rols_id;
//        });
    }
}
