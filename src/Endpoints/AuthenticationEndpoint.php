<?php

namespace MennenOnline\Shopware6Connector\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware6Connector\Interfaces\Endpoint\Shopware6AuthenticationInterface;
use MennenOnline\Shopware6Connector\Enums\Endpoint;
use MennenOnline\Shopware6Connector\Models\AuthResponseModel;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;

class AuthenticationEndpoint extends Shopware6ApiConnector implements Shopware6AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel {
        $this->auth = true;

        return $this->post(Endpoint::TOKEN_AUTH, [
            'grant_type' => 'client_credentials',
            'client_id' => config(self::SHOPWARE6_CLIENT_ID),
            'client_secret' => config(self::SHOPWARE6_CLIENT_SECRET)
        ], true);
    }
}