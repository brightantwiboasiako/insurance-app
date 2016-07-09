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


        Route::group(['prefix' => 'funeral'], function(){

            Route::get('/', [
                'uses' => 'Policy\Funeral\FuneralController@index'
            ]);

        });

    });



    // Customers Route
    Route::group(['prefix' => 'customer'], function(){

        Route::get('/', function(){
            return view('customers.index');
        });

        Route::post('/edit', [
           'uses' => 'CustomerController@edit'
        ]);

        Route::post('/create', [
            'uses' => 'CustomerController@createCustomer'
        ]);

    });


    Route::get('logout', function(){

        while(Auth::check()){
            Auth::logout();
        }

        return redirect('/');

    });

});