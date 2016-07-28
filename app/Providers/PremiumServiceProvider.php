<?php

namespace Aforance\Providers;

use Aforance\Aforance\Service\PremiumService;
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
        
        $this->app->bind('premium', function(){
            return new PremiumService();
        });

    }
}
