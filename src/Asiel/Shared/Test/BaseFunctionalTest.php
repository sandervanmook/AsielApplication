<?php

namespace Asiel\Shared\Test;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class BaseFunctionalTest extends WebTestCase
{
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * Setup the client, load the data fixtures and authenticate.
     */
    public function setUp()
    {
        $this->loadFixtures(array(
            'Asiel\Shared\Test\DataFixtures\LoadUserData',
            'Asiel\Shared\Test\DataFixtures\LoadAnimalData',
            'Asiel\Shared\Test\DataFixtures\LoadStatusData',
            'Asiel\Shared\Test\DataFixtures\LoadCustomerData',
            'Asiel\Shared\Test\DataFixtures\LoadLocationData',
        ));

        $credentials = [
            'username' => 'admin',
            'password' => 'admin'
        ];

        $this->client = $this->makeClient($credentials);
    }

    protected function getContents($path, $method = 'GET')
    {
        $credentials = [
            'username' => 'admin',
            'password' => 'admin'
        ];

        $client = $this->makeClient($credentials);
        $client->request($method, $path);

        $content = $client->getResponse()->getContent();

        return $content;
    }
}
