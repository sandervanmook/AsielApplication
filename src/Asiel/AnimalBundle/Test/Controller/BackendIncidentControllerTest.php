<?php


namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class BackendIncidentControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_incident_index', ['id' => 2]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        // Title
        $this->assertContains('<td>yolo</td>', $contents);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_animal_incident_create', ['id' => 2]);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_show_action()
    {
        $url = $this->getUrl('backend_animal_incident_show', ['incidentid' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        // Title
        $this->assertContains('<p>Gebeurtenis: description</p>', $contents);
    }

    public function test_delete_action()
    {
        $url = $this->getUrl('backend_animal_incident_delete', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }
}