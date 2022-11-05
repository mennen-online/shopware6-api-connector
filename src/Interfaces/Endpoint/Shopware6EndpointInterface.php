<?php

namespace MennenOnline\Shopware6ApiConnector\Interfaces\Endpoint;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;

interface Shopware6EndpointInterface
{
    public function getAll(int|null $limit = null): BaseResponseModel;

    public function getSingle(string $id): BaseResponseModel;

    public function create(array $data = []): BaseResponseModel;

    public function update(string $id, array $data = []): BaseResponseModel;

    public function delete(string $id): BaseResponseModel;
}