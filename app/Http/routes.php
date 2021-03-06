<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return view('dashboard');
    }else{
        return redirect('login');
    }

});


Route::group(['middleware' => 'guest'], function(){

    Route::get('/login', function(){
        return view('auth.login');
    });


    Route::post('/login', [
        'uses' => 'Auth\AuthController@login'
    ]);

});


Route::group(['middleware' => 'auth'], function(){


    // Claim Routes
    Route::group(['prefix' => 'claim'], function(){

        Route::get('/view', [
           'uses' => 'ClaimController@view'
        ]);

        Route::get('/detail', [
           'uses' => 'ClaimController@detail'
        ]);    

        Route::get('/register',  [
           'uses' => 'ClaimController@index'
        ]);

        Route::post('/clients', [
           'uses' => 'ClaimController@clients'
        ]);

        Route::post('/update', [
           'uses' => 'ClaimController@updateClaim'
        ]);
        Route::get('/payment', [
           'uses' => 'ClaimController@payClaim'
        ]);
        Route::post('/registered', [
           'uses' => 'ClaimController@register'
        ]);

        Route::post('/{customer}', [
            'uses' => 'ClaimController@policies'
        ]);

    });


    // Finder routes
    Route::get('/finder', [
        'uses' => 'Finder\FinderController@execute'
    ]);


    // Policies Routes
    Route::group(['prefix' => 'policy'], function(){


        Route::get('metadata', [
           'uses' => 'Policy\PolicyController@getMetadata'
        ]);

        Route::post('create', [
            'uses' => 'Policy\PolicyCreationController@issue'
        ]);


        Route::get('/document/{business}/{policyNumber}', [
            'uses' => 'Policy\PolicyDocumentController@showDocument'
        ]);


        Route::get('/document/{business}/{policyNumber}/download', [
            'uses' => 'Policy\PolicyDocumentController@downloadDocument'
        ]);


        // Funeral Policies
        Route::group(['prefix' => 'funeral'], function(){

            Route::get('/', [
                'uses' => 'Policy\Funeral\FuneralController@index'
            ]);

            Route::get('/create/{customerId}', [
               'uses' => 'Policy\Funeral\FuneralController@getCreationScreen'
            ]);

            Route::get('/{policyNumber}', [
                'uses' => 'Policy\Funeral\FuneralController@getViewScreen'
            ]);

        });

        //Loan protection plan
        Route::group(['prefix' => 'loanprotection'], function(){

            Route::get('/', [
                'uses' => 'Policy\LoanProtection\LoanProtectionController@index'
            ]);

            Route::get('{policyNumber}', [
                'uses' => 'Policy\LoanProtection\LoanProtectionController@getViewScreen'
            ]);

            Route::post('borrower/add/{policyNumber}', [
                'uses' => 'Policy\LoanProtection\LoanProtectionController@addBorrowers'
            ]);

            Route::post('borrower/upload/{policyNumber}', [
                'uses' => 'Policy\LoanProtection\BorrowerUploadController@upload'
            ]);

        });


        // Child Education policy
        Route::group(['prefix' => 'childeducation'], function(){

            Route::get('/', [
                'uses' => 'Policy\ChildEducation\ChildEducationController@index'
            ]);

            Route::get('/create/{customerId}', [
                'uses' => 'Policy\ChildEducation\ChildEducationController@getCreationScreen'
            ]);

            Route::get('/{policyNumber}', [
                'uses' => 'Policy\ChildEducation\ChildEducationController@getViewScreen'
            ]);

        });

    });


    // Application level data routes
    Route::group(['prefix' => 'app'], function(){

        Route::get('agents', [
            'uses' => 'Agency\AgentController@all'
        ]);

        Route::get('branches', [
            'uses' => 'Branch\BranchController@all'
        ]);

    });


    // Customers Route
    Route::group(['prefix' => 'customer'], function(){

        Route::get('/', function(){
            return view('customers.index');
        });

        Route::post('/edit', [
           'uses' => 'Customer\RegistrationController@editCustomer'
        ]);

        Route::post('/create', [
            'uses' => 'Customer\RegistrationController@createCustomer'
        ]);

    });


    Route::get('logout', function(){

        while(Auth::check()){
            Auth::logout();
        }

        return redirect('/');

    });

});