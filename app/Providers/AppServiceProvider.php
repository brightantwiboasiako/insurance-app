<?php

namespace Aforance\Providers;

use Aforance\Aforance\Support\DOMPDF;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind pdf maker
        $this->app->singleton('pdf', function(){
            return new DOMPDF;
        });
    }
}
