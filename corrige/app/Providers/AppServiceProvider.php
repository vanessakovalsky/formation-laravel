<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Route::resourceVerbs([
          'create' => 'créer',
          'update' =>'mettre-a-jour',
          'delete' => 'supprimer'
        ]);*/
        Schema::defaultStringLength(191);
        Blade::directive('toto', function($expression){
          return strtoupper($expression);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
