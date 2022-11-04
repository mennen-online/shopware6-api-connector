<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Unit\Configuration;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class ConnectorTest extends BaseTest
{
    private string $accessToken = 'my-access-token';

    private int $expires_in = 600;

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
        parent::getEnvironmentSetUp($app);

        $app['config']->set('shopware6.url', 'http://localhost');
    }

    /**
     * @test
     */
    public function it_accepts_constructor_shop_credentials_preferred() {
        $instance = Shopware6ApiConnector::authentication(
            client_id: 'my-client_id',
            client_secret: 'my-client_secret'
        );

        $this->assertSame($this->accessToken, $instance->getToken());

        $this->assertSame($this->expires_in, $instance->getExpiresIn());
    }
}