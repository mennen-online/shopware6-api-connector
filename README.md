# Shopware6 API Connector

## Description

A Connector for Shopware 6 API in Laravel Applications.

Currently, these Endpoints are available:

* Authentication
* Category
* CustomerGroup
* Media
* Product
* PropertyGroup
* PropertyGroupOption
* Tax
* TaxRule

## Installation

Install it through composer:

```
composer require mennen-online/shopware6-api-connector
```

Run:
```
php artisan vendor:publish --provider=Shopware6ApiConnectorServiceProvider
```

To connect a single Shop, add to your .env the following Keys:
```
SW6_HOST=<URL TO SHOP>
SW6_CLIENT_ID=<CLIENT ID>
SW6_CLIENT_SECRET=<CLIENT SECRET>
```

It is also Possible to call the connector with following scheme e.g. authentication:

```php
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;

$instance = Shopware6ApiConnector::authentication(
    url: 'http://your-shop.url',
    client_id: 'your-client-id',
    client_secret: 'your-client-secret'  
);
```