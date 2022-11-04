<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Endpoints\CustomerGroupEndpoint;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class CustomerGroupEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_receives_an_instance_of_customer_group_endpoint() {
        $this->fakeLoginResponse();

        $instance = Shopware6ApiConnector::customerGroup();

        $this->assertInstanceOf(CustomerGroupEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::CustomerGroup();

        $this->assertInstanceOf(CustomerGroupEndpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_can_receive_all() {
        Http::fakeSequence(config('shopware6.url'))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]))
            ->pushResponse(Http::response(['data' => '{"total":1,"data":[{"name":"Standard customer group","displayGross":true,"translations":null,"customers":null,"salesChannels":null,"registrationActive":false,"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null,"registrationSalesChannels":null,"_uniqueIdentifier":"cfbd5018d38d41d8adca10d94fc8bdd6","versionId":null,"translated":{"name":"Standard customer group","customFields":{},"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null},"createdAt":"2022-03-03T06:23:16.654+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"cfbd5018d38d41d8adca10d94fc8bdd6","customFields":null,"apiAlias":"customer_group"}],"success":null,"errors":null}']));

        $instance = Shopware6ApiConnector::customerGroup();

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
        Http::fakeSequence(config('shopware6.url'))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]))
            ->pushResponse(Http::response(['data' => '{"total":1,"data":[{"name":"Standard customer group","displayGross":true,"translations":null,"customers":null,"salesChannels":null,"registrationActive":false,"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null,"registrationSalesChannels":null,"_uniqueIdentifier":"cfbd5018d38d41d8adca10d94fc8bdd6","versionId":null,"translated":{"name":"Standard customer group","customFields":{},"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null},"createdAt":"2022-03-03T06:23:16.654+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"cfbd5018d38d41d8adca10d94fc8bdd6","customFields":null,"apiAlias":"customer_group"}],"success":null,"errors":null}']))
            ->pushResponse(Http::response(['data' => '{"name":"Standard customer group","displayGross":true,"translations":null,"customers":null,"salesChannels":null,"registrationActive":false,"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null,"registrationSalesChannels":null,"_uniqueIdentifier":"cfbd5018d38d41d8adca10d94fc8bdd6","versionId":null,"translated":{"name":"Standard customer group","customFields":{},"registrationTitle":null,"registrationIntroduction":null,"registrationOnlyCompanyRegistration":null,"registrationSeoMetaDescription":null},"createdAt":"2022-03-03T06:23:16.654+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"cfbd5018d38d41d8adca10d94fc8bdd6","customFields":null,"apiAlias":"customer_group"}']));

        $instance = Shopware6ApiConnector::customerGroup();

        $collection = collect($instance->getAll()->data);

        $singleFromCollection = $collection->random(1)->first();

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}