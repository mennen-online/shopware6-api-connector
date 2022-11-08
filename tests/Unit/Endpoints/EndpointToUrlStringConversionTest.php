<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Unit\Endpoints;

use MennenOnline\Shopware6ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class EndpointToUrlStringConversionTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_convert_oauth_token_endpoint_correctly() {
        $this->assertSame('oauth/token', EndpointEnum::convertEndpointToUrl(EndpointEnum::OAUTH_TOKEN));
    }

    /**
     * @test
     */
    public function it_can_convert_two_url_parts_in_snake_case_correctly() {
        $this->assertSame('tax-rule', EndpointEnum::convertEndpointToUrl(EndpointEnum::TAX_RULE));
    }

    /**
     * @test
     */
    public function it_can_convert_three_url_parts_in_snake_case_correctly() {
        $this->assertSame('property-group-option', EndpointEnum::convertEndpointToUrl(EndpointEnum::PROPERTY_GROUP_OPTION));
    }
}