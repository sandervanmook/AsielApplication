<?php


namespace Asiel\AnimalBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class BackendFacebookControllerTest extends BaseFunctionalTest
{
    public function test_index_action()
    {
        $url = $this->getUrl('backend_animal_facebook_index', ['id' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('https://www.facebook.com/v2.8/dialog/oauth?client_id=', $contents);

        $this->assertStatusCode(200, $this->client);
    }

    public function test_index_action_logged_in()
    {
        $_SESSION['facebook_access_token'] = 'yolo';
        $url = $this->getUrl('backend_animal_facebook_index', ['id' => 1]);
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('<title>Redirecting to /backend/animal/facebook/post/1</title>', $contents);
    }

    public function test_post_action()
    {
        $url = $this->getUrl('backend_animal_facebook_post', ['id' => 1]);
        $this->client->request('GET', $url);

        $this->assertStatusCode(200, $this->client);
    }

}