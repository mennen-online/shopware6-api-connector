<?php

namespace MennenOnline\Shopware6ApiConnector\Endpoints;

use MennenOnline\Shopware6ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware6ApiConnector\Interfaces\Endpoint\Shopware6EndpointInterface;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;

class Endpoint extends Shopware6ApiConnector
{

    public function getAll(?int $limit = null): BaseResponseModel {
        return $this->index($this->endpoint, $limit);
    }

    public function getSingle(string $id): BaseResponseModel {
        return $this->get($this->endpoint, $id);
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