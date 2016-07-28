<?php

namespace Aforance\Providers;

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
        $this->app->bind('Aforance\Aforance\Support\Contracts\Checker',
                        'Aforance\Aforance\Support\Permission\JsonPermissionChecker');
    }
}
