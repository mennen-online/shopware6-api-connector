<?php

use Illuminate\Support\ServiceProvider;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;

class Shopware6ConnectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Shopware6ApiConnector::class, fn () => new Shopware6ApiConnector());
    }
}
