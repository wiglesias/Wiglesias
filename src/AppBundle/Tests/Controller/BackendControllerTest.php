<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\AbstractBaseTest;

/**
 * Class BackendControllerTest.
 *
 * @category Test
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class BackendControllerTest extends AbstractBaseTest
{
    /**
     * Test admin login request is successful.
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', '/admin/login');

        $this->assertStatusCode(200, $client);
    }

    /**
     * Test HTTP request is successful.
     *
     * @dataProvider provideSuccessfulUrls
     *
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * Successful Urls provider.
     *
     * @return array
     */
    public function provideSuccessfulUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/contact/message/list'),
            array('/admin/contact/message/1/show'),
            array('/admin/contact/message/1/answer'),
            array('/admin/blog/tag/list'),
            array('/admin/blog/tag/create'),
            array('/admin/blog/tag/1/show'),
            array('/admin/blog/tag/1/edit'),
            array('/admin/blog/tag/1/delete'),
            array('/admin/blog/post/list'),
            array('/admin/blog/post/create'),
            array('/admin/blog/post/1/edit'),
            array('/admin/blog/post/1/delete'),
            array('/admin/portfolios/portfolio/list'),
            array('/admin/portfolios/portfolio/create'),
            array('/admin/portfolios/portfolio/1/edit'),
            array('/admin/portfolios/portfolio/1/delete'),
            array('/admin/Portfolio/category/list'),
            array('/admin/Portfolio/category/create'),
            array('/admin/Portfolio/category/1/edit'),
            array('/admin/Portfolio/category/1/delete'),
            array('/admin/setting/profile/list'),
            array('/admin/setting/profile/create'),
            array('/admin/setting/profile/1/edit'),
            array('/admin/setting/profile/1/delete'),
            array('/admin/billing/customer/list'),
            array('/admin/billing/customer/create'),
            array('/admin/billing/customer/1/edit'),
            array('/admin/billing/customer/1/delete'),
            array('/admin/billing/invoice/list'),
            array('/admin/billing/invoice/create'),
            array('/admin/billing/invoice/1/edit'),
            array('/admin/administration/province/list'),
            array('/admin/administration/province/create'),
            array('/admin/administration/province/1/edit'),
            array('/admin/administration/city/list'),
            array('/admin/administration/city/create'),
            array('/admin/administration/city/1/edit'),
            array('/admin/administration/bank/list'),
            array('/admin/administration/bank/create'),
            array('/admin/administration/bank/1/edit'),
            array('/admin/administration/bank/1/delete'),
            array('/admin/users/list'),
            array('/admin/users/create'),
            array('/admin/users/1/edit'),
            array('/admin/users/1/delete'),
        );
    }

    /**
     * Test HTTP request is not found.
     *
     * @dataProvider provideNotFoundUrls
     *
     * @param string $url
     */
    public function testAdminPagesAreNotFound($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Not found Urls provider.
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/contact/message/create'),
            array('/admin/contact/message/1/edit'),
            array('/admin/contact/message/1/delete'),
            array('/admin/contact/message/batch'),
            array('/admin/users/show'),
            array('/admin/users/batch'),
            array('/admin/administration/province/batch'),
            array('/admin/administration/province/1/delete'),
            array('/admin/administration/city/batch'),
            array('/admin/administration/city/1/delete'),
        );
    }
}
