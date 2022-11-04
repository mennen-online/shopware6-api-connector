<?php

namespace MennenOnline\Shopware6ApiConnector\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnectorServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTest extends TestCase
{
    protected string $testUrl = 'http://127.0.0.1';

    protected string $accessToken = 'my-access-token';

    protected int $expires_in = 600;

    protected $loadEnvironmentVariables = true;

    protected function setUp(): void {
        parent::setUp();
    }

    protected function defineEnvironment($app) {
        parent::getEnvironmentSetUp($app);

        $app->useEnvironmentPath(__DIR__.'/..');

        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        $app['config']->set('shopware6', [
            'url' => env('SW6_HOST'),
            'client_id' => env('SW6_CLIENT_ID'),
            'client_secret' => env('SW6_CLIENT_SECRET')
        ]);
    }

    protected function getPackageProviders($app) {
        return [
            Shopware6ApiConnectorServiceProvider::class
        ];
    }

    public function fakeLoginResponse() {
        Http::fakeSequence(config('shopware6.url'))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]));
    }
}