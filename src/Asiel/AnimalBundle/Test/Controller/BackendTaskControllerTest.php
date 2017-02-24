<?php


namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class BackendTaskControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_task_index', ['id' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('<td>Admin</td>', $contents);
    }

    public function test_edit_action()
    {
        $url = $this->getUrl('backend_animal_task_edit', ['id' => 1, 'taskid' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('contents</textarea>', $contents);
    }

    public function test_delete_action()
    {
        $url = $this->getUrl('backend_animal_task_delete', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_create_action()
    {
        $url = $this->getUrl('backend_animal_task_create', ['id' => 1]);
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }

    public function test_info_action()
    {
        $url = $this->getUrl('backend_animal_taskinfo');
        $this->client->request('GET', $url);
        $this->assertStatusCode(200, $this->client);
    }
}
