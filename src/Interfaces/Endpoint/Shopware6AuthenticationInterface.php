<?php

namespace MennenOnline\Shopware6ApiConnector\Interfaces\Endpoint;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use MennenOnline\Shopware6ApiConnector\Models\AuthResponseModel;

interface Shopware6AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel;
}