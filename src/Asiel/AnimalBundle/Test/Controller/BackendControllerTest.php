<?php

namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\Test\BaseFunctionalTest;

class BackendControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_index');
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_show_action()
    {
        $url = $this->getUrl('backend_animal_show', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_animal_create');
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);

        $contents = $this->getContents($url);
        $this->assertContains('<input type="text" id="chipnumbercheck" placeholder="15 cijferige chipnummer" maxlength="15">', $contents);
    }

    public function test_register_action_cat()
    {
        $url = $this->getUrl('backend_animal_register', ['type' => 'Cat']);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_register_action_dog()
    {
        $url = $this->getUrl('backend_animal_register', ['type' => 'Dog']);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_edit_action()
    {
        $url = $this->getUrl('backend_animal_edit', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_find_on_chipnumber()
    {
        $url = $this->getUrl('backend_animal_find_on_chipnumber', ['chipnumber' => 123456789012345]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
        $content = $this->client->getResponse()->getContent();

        $this->assertContains(
            '[{"id":1}]',
            $content
        );
    }

    public function test_search_animals_data_action()
    {
        $url = $this->getUrl('backend_animal_search_data', ['type' => ['Cat']]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
        $content = $this->client->getResponse()->getContent();

        $this->assertContains(
            'Sam',
            $content
        );
    }
}