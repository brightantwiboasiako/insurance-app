<?php

namespace Aforance\Providers;

use Aforance\Aforance\Customer\Registration;
use Aforance\Aforance\Repository\CustomerRepository;
use Aforance\Aforance\Validation\CustomerValidator;
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
        
        $this->app->bind('customer.validator', function(){
            return new CustomerValidator();
        });


        $this->app->bind(
            'customer.notifier',
            '\Aforance\Aforance\Notification\CustomerNotification'
        );


        $this->app->bind('customer.repository', function(){
            return new CustomerRepository();
        });


        $this->app->bind('customer.registration', function(){
            return new Registration(
                app('customer.validator'),
                app('customer.notifier'),
                app('customer.repository')
            );
        });

    }

    public function provides()
    {
        return [
            'customer.notifier',
            'customer.validator',
            'customer.repository',
            'customer.registration'
        ];
    }

}
