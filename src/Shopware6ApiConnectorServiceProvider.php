<?php

namespace MennenOnline\Shopware6ApiConnector;

use Illuminate\Support\ServiceProvider;

class Shopware6ApiConnectorServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/shopware6.php' => config_path('shopware6.php')
        ]);
    }

    public function register()
    {

    }
}
