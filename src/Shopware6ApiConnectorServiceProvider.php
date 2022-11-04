<?php

namespace MennenOnline\Shopware6ApiConnector;

use Illuminate\Support\ServiceProvider;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;

class Shopware6ApiConnectorServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/shopware6.php' => config_path('shopware6.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton(Shopware6ApiConnector::class, fn () => new Shopware6ApiConnector());
    }
}
