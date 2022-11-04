<?php

namespace MennenOnline\Shopware6ApiConnector\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class BaseTest extends TestCase
{
    protected string $accessToken = 'my-access-token';

    protected int $expires_in = 600;

    protected function setUp(): void {
        parent::setUp();

        Http::fake([
            'http://localhost/api/oauth/token' => Http::response([
                'token_type' => 'Bearer',
                'access_token' => $this->accessToken,
                'expires_in' => $this->expires_in
            ])
        ]);
    }

    protected function getEnvironmentSetUp($app) {
        $app->useEnvironmentPath(__DIR__.'/..');

        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        $app['config']->set('shopware6.url', env('SW6_HOST', 'http://localhost'));
        $app['config']->set('shopware6.client_id', env('SW6_CLIENT_ID', 'my-client-id'));
        $app['config']->set('shopware6.client_secret', env('SW6_CLIENT_SECRET', 'my-client-secret'));

        parent::getEnvironmentSetUp($app);
    }
}