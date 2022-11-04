<?php

namespace MennenOnline\Shopware6Connector\Tests\Feature\Endpoints;

use MennenOnline\Shopware6Connector\Endpoints\CategoryEndpoint;
use MennenOnline\Shopware6Connector\Models\BaseResponseModel;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;
use MennenOnline\Shopware6Connector\Tests\BaseTest;

class CategoryEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_receives_an_instance_of_category_endpoint() {
        $instance = Shopware6ApiConnector::Category();

        $this->assertInstanceOf(CategoryEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::category();

        $this->assertInstanceOf(CategoryEndpoint::class, $instance);
    }
    /**
     * @test
     */
    public function it_can_receive_all() {
        $instance = Shopware6ApiConnector::category();

        $response = $instance->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('total', $response->getAttributes());

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertNull($response->getAttributes()['errors']);

        $this->assertSame($response->total, count($response->data));
    }

    /**
     * @test
     */
    public function it_can_receive_a_single() {
        $instance = Shopware6ApiConnector::category();

        $collection = collect($instance->getAll()->data);

        $singleFromCollection = $collection->random(1)->first();

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}