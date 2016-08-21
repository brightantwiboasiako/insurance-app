<?php

namespace Aforance\Providers;

use Aforance\Aforance\Repository\AgentRepository;
use Aforance\Aforance\Repository\CommissionRepository;
use Aforance\Aforance\Service\AgencyService;
use Illuminate\Support\ServiceProvider;

class AgencyServiceProvider extends ServiceProvider
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

        $this->app->singleton('agency.repository', function(){
            return new AgentRepository;
        });

        $this->app->bind('Aforance\Aforance\Repository\Contracts\AgentRepositoryInterface',
            'Aforance\Aforance\Repository\AgentRepository');

        $this->app->singleton('agency', function(){
            return new AgencyService;
        });


        $this->app->bind('agency.rates', function(){
            return [
                'tax' => 0.10
            ];
        });


        $this->app->bind('agency.commissions', function(){
            return new CommissionRepository;
        });

    }
}
