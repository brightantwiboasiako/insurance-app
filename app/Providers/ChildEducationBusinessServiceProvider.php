<?php

namespace Aforance\Providers;

use Aforance\Aforance\Business\ChildEducation\ChildEducationBusiness;
use Aforance\Aforance\Business\ChildEducation\ChildEducationRepository;
use Aforance\Aforance\Business\ChildEducation\NumberGenerator;
use Aforance\Aforance\Business\ChildEducation\Premium\PremiumCalculator;
use Aforance\Aforance\Business\ChildEducation\Validation\ChildEducationPolicyValidator;
use Aforance\Aforance\Business\ChildEducation\Validation\ChildHandler;
use Aforance\Aforance\Business\ChildEducation\Validation\PolicyHandler;
use Aforance\Aforance\Business\PremiumLoader\JsonPremiumLoader;
use Illuminate\Support\ServiceProvider;

class ChildEducationBusinessServiceProvider extends ServiceProvider
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


        // Premium Calculator
        $this->app->singleton('childeducation.calculator', function(){
            return new PremiumCalculator(
                app('childeducation.premium_loader')
            );
        });

        // Premium Loader
        $this->app->singleton('childeducation.premium_loader', function(){
            $premiumFile = base_path().'/files/premiums/childeducation.json';
            return new JsonPremiumLoader($premiumFile);
        });


        // Bind the child education business
        $this->app->bind('business.childeducation', function(){
            return new ChildEducationBusiness(
                app('childeducation.contracts.validator'),
                app('childeducation.contracts.repository')
            ) ;
        });


        // Policy number generator
        $this->app->bind('childeducation.number_generator', function(){
            return new NumberGenerator;
        });


        // Repository
        $this->app->singleton('childeducation.contracts.repository', function(){
            return new ChildEducationRepository;
        });


        // Validator
        $this->app->bind('childeducation.contracts.validator', function(){
            return new ChildEducationPolicyValidator;
        });


        // Validation handlers
        $this->app->bind('childeducation.validation.handlers', function(){
            return [
                new PolicyHandler,
                new ChildHandler
            ];
        });

    }
}
