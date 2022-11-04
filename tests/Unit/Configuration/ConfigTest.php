<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Configuration;

use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class ConfigTest extends BaseTest
{
    /**
     * @test
     */
    public function it_has_shopware6_url() {
        $this->assertNotNull(config('shopware6.url'));
    }

    /**
     * @test
     */
    public function it_has_shopware6_client_id() {
        $this->assertNotNull(config('shopware6.client_id'));
    }

    /**
     * @test
     */
    public function it_has_shopware6_client_secret() {
        $this->assertNotNull(config('shopware6.client_secret'));
    }
}