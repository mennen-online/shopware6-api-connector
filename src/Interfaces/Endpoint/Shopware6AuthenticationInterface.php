<?php

namespace MennenOnline\Shopware6Connector\Interfaces\Endpoint;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use MennenOnline\Shopware6Connector\Models\AuthResponseModel;

interface Shopware6AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel;
}