<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Endpoints\AuthenticationEndpoint;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Models\AuthResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class AuthenticationEndpointTest extends BaseTest
{
    protected function setUp(): void {
        parent::setUp();

        /*Http::fake([
            Endpoint::TOKEN_AUTH->value => Http::response([
                ''
            ])
        ]);*/
    }

    /**
     * @test
     */
    public function it_returns_an_instance_of_authentication_endpoint() {
        $instance = Shopware6ApiConnector::Authentication();

        $this->assertInstanceOf(AuthenticationEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::authentication();

        $this->assertInstanceOf(AuthenticationEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_receives_a_token_with_seconds_to_expire() {
        $instance = Shopware6ApiConnector::authentication();

        $response = $instance->oAuthToken();

        $this->assertInstanceOf(AuthResponseModel::class, $response);

        $this->assertNotNull($response->type);

        $this->assertNotNull($response->token);

        $this->assertNotNull($response->expires_in);

        $this->assertTrue(Carbon::parse($response->expires_in)->isValid());
    }
}