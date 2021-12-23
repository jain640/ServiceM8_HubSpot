<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Support\ServiceProvider;

class SyncEzyServiceM8HubSpotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('SnycEzy\ServiceM8_HubSpot\SyncEzyServiceM8HubSpotController');
        $this->loadViewsFrom(__DIR__.'/views', 'servicem8hubspot');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }
}

