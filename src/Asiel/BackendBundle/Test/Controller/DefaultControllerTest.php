<?php


namespace Asiel\BackendBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class DefaultControllerTest extends BaseFunctionalTest
{
    public function test_index_action_with_chrome()
    {
        $url = $this->getUrl('backend_default_index');
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }
}
