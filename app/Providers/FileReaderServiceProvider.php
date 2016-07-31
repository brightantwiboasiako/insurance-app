<?php

namespace Aforance\Providers;

use Aforance\Aforance\Support\FileReader\CsvFileReader;
use Illuminate\Support\ServiceProvider;

class FileReaderServiceProvider extends ServiceProvider
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
        $this->app->bind('filereader.csv', function(){
            return new CsvFileReader;
        });
    }
}
