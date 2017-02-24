<?php

namespace Asiel\Shared\TestTools;


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
            'Asiel\Shared\TestTools\DataFixtures\LoadUserData',
            'Asiel\Shared\TestTools\DataFixtures\LoadAnimalData',
            'Asiel\Shared\TestTools\DataFixtures\LoadStatusData',
            'Asiel\Shared\TestTools\DataFixtures\LoadCustomerData',
            'Asiel\Shared\TestTools\DataFixtures\LoadLocationData',
            'Asiel\Shared\TestTools\DataFixtures\LoadBookkeepingSettingsData',
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
