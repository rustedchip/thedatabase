<?php

namespace Rustedchip\TheDatabase;

use Illuminate\Support\ServiceProvider;

class TheDatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Rustedchip\TheDatabase\TheDatabaseController');
        $this->loadViewsFrom(__DIR__.'/views', 'thedatabase');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
              
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/assets' => public_path('thedatabase'),
        ], 'public');
        

        
    }
}
