<?php

namespace MennenOnline\Shopware6Connector\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use MennenOnline\Shopware6Connector\Enums\Endpoint;
use MennenOnline\Shopware6Connector\Interfaces\Endpoint\Shopware6EndpointInterface;
use MennenOnline\Shopware6Connector\Models\BaseResponseModel;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;

class ProductEndpoint extends Shopware6ApiConnector implements Shopware6EndpointInterface
{

    public function getAll(): BaseResponseModel {
        return $this->index(Endpoint::PRODUCT);
    }

    public function getSingle(string $id): BaseResponseModel {
        return $this->get(Endpoint::PRODUCT, $id);
    }

    public function create(array $data = []): BaseResponseModel {
        // TODO: Implement create() method.
    }

    public function update(string $id, array $data = []): BaseResponseModel {
        // TODO: Implement update() method.
    }

    public function delete(string $id): BaseResponseModel {
        // TODO: Implement delete() method.
    }
}