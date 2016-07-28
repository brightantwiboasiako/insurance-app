<?php

namespace Aforance\Providers;

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
        $this->app->bind('Aforance\Aforance\Repository\Contracts\AgentRepositoryInterface',
            'Aforance\Aforance\Repository\AgentRepository');
    }
}
