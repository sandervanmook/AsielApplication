<?php


namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class BackendStatusControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_status_index', ['id' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);

        $this->assertContains('<td>Gevonden</td>', $contents);
        $this->assertContains('<td>Actief</td>', $contents);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_animal_status_create', ['id' => 1]);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_type_action()
    {
        $url = $this->getUrl('backend_animal_status_create_type', ['id' => 3, 'type' => 'Lost']);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_show_action()
    {
        $url = $this->getUrl('backend_animal_status_show', ['statusid' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);

        $this->assertContains('<h3 class="ui header">Status 1</h3>', $contents);
        $this->assertContains('<p>Type status:  Vermist</p>', $contents);
    }

    public function test_delete_action()
    {
        $url = $this->getUrl('backend_animal_status_delete', ['statusid' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }
}