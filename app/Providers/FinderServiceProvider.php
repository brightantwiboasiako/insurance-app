<?php

namespace Aforance\Providers;

use Aforance\Aforance\Contracts\Finder\FinderEngineInterface;
use Aforance\Aforance\Finder\EloquentEngine;
use Illuminate\Support\ServiceProvider;

class FinderServiceProvider extends ServiceProvider
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
        $this->app->bind('Aforance\Aforance\Contracts\Finder\FinderEngineInterface', function(){
            return new EloquentEngine();
        });
    }

    public function provides()
    {
        return parent::provides();
    }
}
