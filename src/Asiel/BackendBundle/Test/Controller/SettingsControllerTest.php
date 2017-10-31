<?php


namespace Asiel\BackendBundle\Test\Controller;


use Asiel\Shared\TestTools\BaseFunctionalTest;

class SettingsControllerTest extends BaseFunctionalTest
{
    public function test_bookkeeping_action()
    {
        $url = $this->getUrl('backend_settings_bookkeeping');
        $this->client->request('GET', $url);

        $contents = $this->getContents($url);
        $this->assertContains('id="asiel_backendbundle_bookkeepingsettings_priceFoundNotVaccinated"', $contents);
    }
}
