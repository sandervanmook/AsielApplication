<?php


namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class BackendPictureControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_picture_index', ['id' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        // Image public source and name
        $this->assertContains('img src="/pictures/animals/yolo"', $contents);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_show_action()
    {
        $url = $this->getUrl('backend_animal_picture_show', ['pictureid' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        // Image public source and name
        $this->assertContains('src="/pictures/animals/yolo"', $contents);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_animal_picture_create', ['id' => 1]);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_delete_action()
    {
        $url = $this->getUrl('backend_animal_picture_delete', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

}