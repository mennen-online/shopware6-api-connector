<?php

namespace MennenOnline\Shopware6Connector\Tests\Feature\Endpoints;

use MennenOnline\Shopware6Connector\Endpoints\MediaEndpoint;
use MennenOnline\Shopware6Connector\Models\BaseResponseModel;
use MennenOnline\Shopware6Connector\Shopware6ApiConnector;
use MennenOnline\Shopware6Connector\Tests\BaseTest;

class MediaEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_receives_an_instance_of_media_endpoint() {
        $instance = Shopware6ApiConnector::media();

        $this->assertInstanceOf(MediaEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::Media();

        $this->assertInstanceOf(MediaEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_can_receive_all() {
        $instance = Shopware6ApiConnector::media();

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
        $instance = Shopware6ApiConnector::media();

        $collection = collect($instance->getAll()->data);

        $singleFromCollection = $collection->random(1)->first();

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}