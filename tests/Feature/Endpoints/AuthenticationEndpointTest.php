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
    }

    /**
     * @test
     */
    public function it_returns_an_instance_of_authentication_endpoint() {
        $this->fakeLoginResponse();

        $instance = Shopware6ApiConnector::Authentication();

        $this->assertInstanceOf(AuthenticationEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::authentication();

        $this->assertInstanceOf(AuthenticationEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_receives_a_token_with_seconds_to_expire_and_its_type() {
        Http::fakeSequence(config('shopware6.url'))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]));

        $instance = Shopware6ApiConnector::authentication();

        $response = $instance->oAuthToken();

        $this->assertInstanceOf(AuthResponseModel::class, $response);

        $this->assertNotNull($response->type);

        $this->assertNotNull($response->token);

        $this->assertNotNull($response->expires_in);

        $this->assertTrue(Carbon::parse($response->expires_in)->isValid());
    }
}