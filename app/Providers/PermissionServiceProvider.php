<?php

namespace Aforance\Providers;

use Aforance\Aforance\Support\Permission\JsonPermissionChecker;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
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
        $this->app->singleton('permission.checker', function(){
            return new JsonPermissionChecker;
        });
    }
}
