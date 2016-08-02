<?php

namespace Aforance\Providers;

use Aforance\Aforance\Service\PolicyService;
use Illuminate\Support\ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
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
        // Bind an instance of PolicyService
        $this->app->singleton('policy', function(){
            return new PolicyService;
        });
    }
}
