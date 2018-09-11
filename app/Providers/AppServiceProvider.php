<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->instance('path.public', '/var/www/html/guayaco');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    // $this->app->bind('path.public', function() {
    //return base_path().'/html/guayaco';
    //});

    }
}
