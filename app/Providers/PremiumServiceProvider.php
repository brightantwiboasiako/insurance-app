<?php

namespace Aforance\Providers;

use Aforance\Aforance\Premium\PremiumRepository;
use Aforance\Aforance\Premium\Verifier\AmountDisparityVerifier;
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

        // Bind premium service
        $this->app->bind('premium', function(){
            return new PremiumService;
        });


        // Bind a premium repository
        $this->app->singleton('premium.repository', function(){
            return new PremiumRepository;
        });


        // Bind premium data handlers
        // These handlers are for checking the validity of
        // premium data
        $this->app->bind('premium.validation.handlers', function(){
            return [

            ];
        });


        // Bind premium verifiers
        // These are different from validation handlers
        // in the sense that they verify some conditions
        // and either modify the premium data wherever necessary

        // They throw fatal exceptions to prevent the propagation
        // of the premium data
        $this->app->bind('premium.verifiers', function(){
            return [
                new AmountDisparityVerifier // verifies premium amount
            ];
        });

    }
}
