<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Unit\Configuration;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class ConnectorTest extends BaseTest
{
    protected function setUp(): void {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_accepts_constructor_shop_credentials_preferred() {
        $instance = Shopware6ApiConnector::authentication(
            url: 'http://localhost',
            client_id: 'my-client_id',
            client_secret: 'my-client_secret'
        );

        $this->assertSame($this->accessToken, $instance->getToken());

        $this->assertSame($this->expires_in, $instance->getExpiresIn());
    }
}