<?php

namespace MennenOnline\Shopware6ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware6ApiConnector\Endpoints\CategoryEndpoint;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware6ApiConnector\Shopware6ApiConnector;
use MennenOnline\Shopware6ApiConnector\Tests\BaseTest;

class CategoryEndpointTest extends BaseTest
{
    protected function setUp(): void {
        parent::setUp();
    }

    protected function getEnvironmentSetUp($app) {
        parent::getEnvironmentSetUp($app);
    }

    /**
     * @test
     */
    public function it_receives_an_instance_of_category_endpoint() {
        $this->fakeLoginResponse();

        $instance = Shopware6ApiConnector::Category();

        $this->assertInstanceOf(CategoryEndpoint::class, $instance);

        $instance = Shopware6ApiConnector::category();

        $this->assertInstanceOf(CategoryEndpoint::class, $instance);
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
            ->pushResponse(Http::response('{"total":9,"data":[{"afterCategoryId":null,"parentId":"77b959cf66de4c1590c7f9b7da3982f3","autoIncrement":3,"mediaId":null,"name":"Bakery products","breadcrumb":["Catalogue #1","Food","Bakery products"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|77b959cf66de4c1590c7f9b7da3982f3|","level":3,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"19ca405790ff4f07aac8c599d4317868","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Food","Bakery products"],"name":"Bakery products","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.043+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"19ca405790ff4f07aac8c599d4317868","customFields":null,"apiAlias":"category"},{"afterCategoryId":"8de9b484c54f441c894774e5f57e485c","parentId":"a515ae260223466f8e37471d279e6406","autoIncrement":8,"mediaId":null,"name":"Men","breadcrumb":["Catalogue #1","Clothing","Men"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|a515ae260223466f8e37471d279e6406|","level":3,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"2185182cbbd4462ea844abeb2a438b33","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Clothing","Men"],"name":"Men","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.045+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"2185182cbbd4462ea844abeb2a438b33","customFields":null,"apiAlias":"category"},{"afterCategoryId":"a515ae260223466f8e37471d279e6406","parentId":"a74cfacc8ce2416f8ee843ccc931c3fe","autoIncrement":9,"mediaId":null,"name":"Free time & electronics","breadcrumb":["Catalogue #1","Free time & electronics"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|","level":2,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"251448b91bc742de85643f5fccd89051","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Free time & electronics"],"name":"Free time & electronics","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.045+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"251448b91bc742de85643f5fccd89051","customFields":null,"apiAlias":"category"},{"afterCategoryId":"19ca405790ff4f07aac8c599d4317868","parentId":"77b959cf66de4c1590c7f9b7da3982f3","autoIncrement":4,"mediaId":null,"name":"Fish","breadcrumb":["Catalogue #1","Food","Fish"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|77b959cf66de4c1590c7f9b7da3982f3|","level":3,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"48f97f432fd041388b2630184139cf0e","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Food","Fish"],"name":"Fish","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.043+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"48f97f432fd041388b2630184139cf0e","customFields":null,"apiAlias":"category"},{"afterCategoryId":null,"parentId":"a74cfacc8ce2416f8ee843ccc931c3fe","autoIncrement":2,"mediaId":null,"name":"Food","breadcrumb":["Catalogue #1","Food"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|","level":2,"active":false,"childCount":3,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"77b959cf66de4c1590c7f9b7da3982f3","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Food"],"name":"Food","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.042+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"77b959cf66de4c1590c7f9b7da3982f3","customFields":null,"apiAlias":"category"},{"afterCategoryId":null,"parentId":"a515ae260223466f8e37471d279e6406","autoIncrement":7,"mediaId":null,"name":"Women","breadcrumb":["Catalogue #1","Clothing","Women"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|a515ae260223466f8e37471d279e6406|","level":3,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"8de9b484c54f441c894774e5f57e485c","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Clothing","Women"],"name":"Women","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.044+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"8de9b484c54f441c894774e5f57e485c","customFields":null,"apiAlias":"category"},{"afterCategoryId":"77b959cf66de4c1590c7f9b7da3982f3","parentId":"a74cfacc8ce2416f8ee843ccc931c3fe","autoIncrement":6,"mediaId":null,"name":"Clothing","breadcrumb":["Catalogue #1","Clothing"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|","level":2,"active":true,"childCount":2,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"a515ae260223466f8e37471d279e6406","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Clothing"],"name":"Clothing","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.044+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"a515ae260223466f8e37471d279e6406","customFields":null,"apiAlias":"category"},{"afterCategoryId":null,"parentId":null,"autoIncrement":1,"mediaId":null,"name":"Catalogue #1","breadcrumb":["Catalogue #1"],"path":null,"level":1,"active":true,"childCount":3,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"695477e02ef643e5a016b83ed4cdf63a","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"a74cfacc8ce2416f8ee843ccc931c3fe","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1"],"name":"Catalogue #1","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:23:16.661+00:00","updatedAt":"2022-03-03T06:28:09.042+00:00","extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"a74cfacc8ce2416f8ee843ccc931c3fe","customFields":null,"apiAlias":"category"},{"afterCategoryId":"48f97f432fd041388b2630184139cf0e","parentId":"77b959cf66de4c1590c7f9b7da3982f3","autoIncrement":5,"mediaId":null,"name":"Sweets","breadcrumb":["Catalogue #1","Food","Sweets"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|77b959cf66de4c1590c7f9b7da3982f3|","level":3,"active":true,"childCount":0,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"bb22b05bff9140f3808b1cff975b75eb","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Food","Sweets"],"name":"Sweets","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.043+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"bb22b05bff9140f3808b1cff975b75eb","customFields":null,"apiAlias":"category"}],"success":null,"errors":null}'));

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

        Http::fakeSequence(config('shopware6.url'))
            ->pushResponse(Http::response([
                'token_type' => 'Bearer',
                'expires_in' => 600,
                'access_token' => 'my-access-token'
            ]))
            ->pushResponse(Http::response(['data' => '{"total":null,"data":{"afterCategoryId":null,"parentId":"a74cfacc8ce2416f8ee843ccc931c3fe","autoIncrement":2,"mediaId":null,"name":"Food","breadcrumb":["Catalogue #1","Food"],"path":"|a74cfacc8ce2416f8ee843ccc931c3fe|","level":2,"active":false,"childCount":3,"visibleChildCount":0,"displayNestedProducts":true,"parent":null,"children":null,"translations":null,"media":null,"products":null,"nestedProducts":null,"tags":null,"cmsPageId":"9758f8c82a2b4ebfa2a513c3fa498eb4","cmsPage":null,"productStreamId":null,"productStream":null,"slotConfig":null,"navigationSalesChannels":null,"footerSalesChannels":null,"serviceSalesChannels":null,"linkType":null,"linkNewTab":null,"internalLink":null,"externalLink":null,"visible":true,"type":"page","productAssignmentType":"product","description":null,"metaTitle":null,"metaDescription":null,"keywords":null,"mainCategories":null,"seoUrls":null,"_uniqueIdentifier":"77b959cf66de4c1590c7f9b7da3982f3","versionId":"0fa91ce3e96a4bc2be4bd9ce752c3425","translated":{"breadcrumb":["Catalogue #1","Food"],"name":"Food","customFields":{},"slotConfig":null,"linkType":null,"internalLink":null,"externalLink":null,"linkNewTab":null,"description":null,"metaTitle":null,"metaDescription":null,"keywords":null},"createdAt":"2022-03-03T06:28:09.042+00:00","updatedAt":null,"extensions":{"foreignKeys":{"apiAlias":null,"extensions":[]}},"id":"77b959cf66de4c1590c7f9b7da3982f3","customFields":null,"apiAlias":"category"},"success":null,"errors":null}']));

        $response = $instance->getSingle($singleFromCollection->id);

        $this->assertInstanceOf(BaseResponseModel::class, $response);

        $this->assertArrayHasKey('data', $response->getAttributes());

        $this->assertSame($singleFromCollection->id, $response->data->id);

        $this->assertNotSame($singleFromCollection, $response->data);
    }
}