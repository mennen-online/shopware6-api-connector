<?php

namespace MennenOnline\Shopware6ApiConnector\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Interfaces\Endpoint\Shopware6EndpointInterface;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;

class TaxRuleEndpoint extends Shopware6ApiConnector implements Shopware6EndpointInterface
{

    public function getAll(): BaseResponseModel {
        return $this->index(Endpoint::TAX_RULE);
    }

    public function getSingle(string $id): BaseResponseModel {
        return $this->get(Endpoint::TAX_RULE, $id);
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