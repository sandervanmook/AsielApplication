<?php


namespace Asiel\LocationBundle\Test\Controller;

use Asiel\Shared\Test\BaseFunctionalTest;

class BackendControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_location_index');
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('<td>Lokaal 1</td>', $contents);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_location_create');
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_delete_action()
    {
        $url = $this->getUrl('backend_location_delete', ['id' => 1]);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }
}