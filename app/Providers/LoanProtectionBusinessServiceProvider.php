<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 7/29/2016
 * Time: 7:56 AM
 */

namespace Aforance\Providers;

use Aforance\Aforance\Business\LoanProtection\LoanProtectionNumberGenerator;
use Aforance\Aforance\Business\LoanProtection\Validation\CsvFileHandler;
use Illuminate\Support\ServiceProvider;
use Aforance\Aforance\Business\LoanProtection\CustomerNotification;
use Aforance\Aforance\Business\LoanProtection\LoanProtectionBusiness;
use Aforance\Aforance\Business\LoanProtection\LoanProtectionRepository;
use Aforance\Aforance\Business\LoanProtection\Validation\BorrowerHandler;
use Aforance\Aforance\Business\LoanProtection\Validation\FinancierHandler;
use Aforance\Aforance\Business\LoanProtection\Premium\LoanProtectionPremiumCalculator;
use Aforance\Aforance\Business\LoanProtection\Validation\LoanProtectionPolicyValidator;


class LoanProtectionBusinessServiceProvider extends ServiceProvider
{

    public function boot(){
        
    }

    public function register()
    {
        // Bind Plan Name
        $this->app->bind('loanprotection.name', function(){
            return 'LOAN PROTECTION PLAN';
        });

        // Bind premium calculator
        $this->app->bind('loanprotection.calculator', function(){
            return new LoanProtectionPremiumCalculator;
        });

        // Bind this business
        $this->app->bind('business.loanprotection', function(){
            return new LoanProtectionBusiness(
                app('loanprotection.validation_contract'),
                app('loanprotection.repository_contract')
            ); 
        });


        // Bind policy number generator
        $this->app->bind('loanprotection.number_generator', function(){
            return new LoanProtectionNumberGenerator;
        });


        // Bind repository contract
        $this->app->bind('loanprotection.repository_contract', function(){
            return new LoanProtectionRepository;
        });

        // Bind customer notification
        $this->app->bind('loanprotection.customer_notifier', function(){
            return new CustomerNotification;
        });


        // Bind validation contract
        $this->app->bind('loanprotection.validation_contract', function(){
            return new LoanProtectionPolicyValidator;
        });


        // Bind validation handlers
        $this->app->bind('loanprotection.validation.handlers', function(){
            return [
                new FinancierHandler,
                new BorrowerHandler
            ];
        });

        $this->app->bind('loanprotection.validation.borrower', function(){
            return new BorrowerHandler;
        });

        $this->app->bind('loanprotection.validation.upload', function(){
            return new CsvFileHandler;
        });


    }
}