<?php

namespace Aforance\Providers;

use Illuminate\Support\ServiceProvider;

class FuneralBusinessServiceProvider extends ServiceProvider
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
        $this->app->bind('Aforance\Aforance\Validation\FuneralPolicyValidator', function(){
            return new \Aforance\Aforance\Validation\FuneralPolicyValidator;
        });

        $this->app->bind('Aforance\Aforance\Repository\FuneralPolicyRepository', function(){
            return new \Aforance\Aforance\Repository\FuneralPolicyRepository;
        });

        $this->app->bind('Aforance\Aforance\Business\FuneralBusiness', function($app){
            return new \Aforance\Aforance\Business\FuneralBusiness(
                app('Aforance\Aforance\Validation\FuneralPolicyValidator'),
                app('Aforance\Aforance\Repository\FuneralPolicyRepository')
            );
        });
    }
}
