<?php

namespace Aforance\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
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
        
        $this->app->bind('\Aforance\Aforance\Validation\CustomerValidator', function(){
            return new \Aforance\Aforance\Validation\CustomerValidator();
        });


        $this->app->bind(
            '\Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface',
            '\Aforance\Aforance\Notification\CustomerNotification'
        );


        $this->app->bind('\Aforance\Aforance\Repository\CustomerRepository', function(){
            return new \Aforance\Aforance\Repository\CustomerRepository;
        });


        $this->app->bind('\Aforance\Aforance\Customer\Registration', function($app){
            return new \Aforance\Aforance\Customer\Registration(
                $app->make('\Aforance\Aforance\Validation\CustomerValidator'),
                $app->make('\Aforance\Aforance\Notification\Contracts\CustomerNotificationInterface'),
                $app->make('\Aforance\Aforance\Repository\CustomerRepository')
            );
        });

    }
}
