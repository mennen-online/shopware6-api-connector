<?php

namespace MennenOnline\Shopware6ApiConnector\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware6ApiConnector\Interfaces\Endpoint\Shopware6AuthenticationInterface;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Models\AuthResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;

/**
 * @inheritdoc
 */

class AuthenticationEndpoint extends Shopware6ApiConnector implements Shopware6AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel {
        $this->auth = true;

        return $this->post(Endpoint::OAUTH_TOKEN, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id ?? config(self::SHOPWARE6_CLIENT_ID),
            'client_secret' => $this->client_secret ?? config(self::SHOPWARE6_CLIENT_SECRET)
        ]);
    }
}