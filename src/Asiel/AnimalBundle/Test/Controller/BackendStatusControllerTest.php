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
        $this->markTestIncomplete('de rest nog testen');
    }

    // TODO show action naar inhoud kijken
}