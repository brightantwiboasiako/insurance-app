<?php

namespace Aforance\Providers;

use Aforance\Aforance\Business\Funeral\FuneralBusiness;
use Aforance\Aforance\Business\Funeral\FuneralNumberGenerator;
use Aforance\Aforance\Business\Funeral\ValidationHandler\FamilyHandler;
use Aforance\Aforance\Business\Funeral\ValidationHandler\PolicyHandler;
use Aforance\Aforance\Business\Funeral\ValidationHandler\UnderwritingHandler;
use Aforance\Aforance\Premium\Calculators\FuneralPremiumCalculator;
use Aforance\Aforance\Premium\Loaders\JsonFuneralPremiumLoader;
use Aforance\Aforance\Repository\FuneralPolicyRepository;
use Aforance\Aforance\Validation\FuneralPolicyValidator;
use Illuminate\Support\ServiceProvider;

class FuneralBusinessServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('funeral.validation_contract', function(){
            return new FuneralPolicyValidator();
        });

        $this->app->bind('funeral.repository_contract', function(){
            return new FuneralPolicyRepository();
        });

        $this->app->bind('business.funeral', function(){
            return new FuneralBusiness(
                app('funeral.validation_contract'),
                app('funeral.repository_contract')
            );
        });

        $this->app->bind('funeral.premium_loader', function(){
            return new JsonFuneralPremiumLoader();
        });

        $this->app->bind('funeral.calculator', function(){
            return new FuneralPremiumCalculator(
                app('funeral.premium_loader')
            );
        });

        $this->app->bind('funeral.number_generator', function(){
            return new FuneralNumberGenerator();
        });

        $this->app->bind('funeral.validators', function(){
            return [
                new UnderwritingHandler,
                new PolicyHandler,
                new FamilyHandler

            ];
        });

    }


    public function provides()
    {
        return [
            'business.funeral',
            'funeral.premium_loader',
            'funeral.validation_contract',
            'funeral.repository_contract',
            'funeral.number_generator'
        ];
    }

}
