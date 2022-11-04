<?php

namespace MennenOnline\Shopware6ApiConnector;

use Illuminate\Support\ServiceProvider;
use MennenOnline\Shopware6ApiConnector\Endpoints\AuthenticationEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\CategoryEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\CustomerGroupEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\MediaEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\ProductEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\PropertyGroupEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\PropertyGroupOptionEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\TaxEndpoint;
use MennenOnline\Shopware6ApiConnector\Endpoints\TaxRuleEndpoint;
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
        $this->app->singleton(AuthenticationEndpoint::class, function() {
            return Shopware6ApiConnector::authentication();
        });

        $this->app->singleton(CategoryEndpoint::class, function() {
            return Shopware6ApiConnector::category();
        });

        $this->app->singleton(CustomerGroupEndpoint::class, function() {
            return Shopware6ApiConnector::customerGroup();
        });

        $this->app->singleton(MediaEndpoint::class, function() {
            return Shopware6ApiConnector::media();
        });

        $this->app->singleton(ProductEndpoint::class, function() {
            return Shopware6ApiConnector::product();
        });

        $this->app->singleton(PropertyGroupEndpoint::class, function() {
            return Shopware6ApiConnector::propertyGroup();
        });

        $this->app->singleton(PropertyGroupOptionEndpoint::class, function() {
            return Shopware6ApiConnector::propertyGroupOption();
        });

        $this->app->singleton(TaxEndpoint::class, function() {
            return Shopware6ApiConnector::tax();
        });

        $this->app->singleton(TaxRuleEndpoint::class, function() {
            return Shopware6ApiConnector::taxRule();
        });
    }
}
