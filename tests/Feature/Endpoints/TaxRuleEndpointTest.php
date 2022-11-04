<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Feature\Endpoints;

use MennenOnline\Shopware6ApiConnector\Endpoints\TaxRuleEndpoint;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class TaxRuleEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_receives_an_instance_of_tax_rule_endpoint() {
        $instance = Shopware6ApiConnector::taxRule();

        $this->assertInstanceOf(TaxRuleEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::TaxRule();

        $this->assertInstanceOf(TaxRuleEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_can_receive_all() {
        $instance = Shopware6ApiConnector::taxRule();

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
        $instance = Shopware6ApiConnector::taxRule();

        $collection = collect($instance->getAll()->data);

        $singleFromCollection = $collection->random(1)->first();

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}