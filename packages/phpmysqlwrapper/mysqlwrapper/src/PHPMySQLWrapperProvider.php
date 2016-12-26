<?php

namespace PHPMySQLWrapper\MySQLWrapper;

use Illuminate\Support\ServiceProvider;
use Config;
use Illuminate\Support\Facades\App;

class PHPMySQLWrapperProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('wrapper', function(){

            return new \PHPMySQLWrapper\MySQLWrapper\Wrapper;
        });
    }
}
