<?php

namespace Aforance\Providers;

use Illuminate\Support\ServiceProvider;

class PremiumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind('Aforance\Aforance\Service\PremiumService', function(){
            return new \Aforance\Aforance\Service\PremiumService;
        });

    }
}
