<?php

namespace MennenOnline\Shopware6Connector\Tests\Feature\Endpoints;

use MennenOnline\Shopware6Connector\Endpoints\PropertyGroupEndpoint;
use MennenOnline\Shopware6Connector\Models\BaseResponseModel;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;
use MennenOnline\Shopware6Connector\Tests\BaseTest;

class PropertyGroupEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_receives_an_instance_of_property_group_endpoint() {
        $instance = Shopware6ApiConnector::propertyGroup();

        $this->assertInstanceOf(PropertyGroupEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::PropertyGroup();

        $this->assertInstanceOf(PropertyGroupEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_can_receive_all() {
        $instance = Shopware6ApiConnector::propertyGroup();

        $response = $instance->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('total', $response->getAttributes());

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($response->total, count($response->data));
    }

    /**
     * @test
     */
    public function it_can_receive_a_single() {
        $instance = Shopware6ApiConnector::propertyGroup();

        $collection = collect($instance->getAll()->data);

        $singleFromCollection = $collection->random(1)->first();

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}