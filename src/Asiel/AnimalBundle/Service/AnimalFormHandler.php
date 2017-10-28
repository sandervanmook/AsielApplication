<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandlerTrait;
use GuzzleHttp;

class AnimalFormHandler
{
    use BaseFormHandlerTrait;

    public function find(int $animalId): Animal
    {
        return $this->findAnimal($animalId);
    }

    public function create(Animal $animal)
    {
        $this->getEm()->persist($animal);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier is aangemaakt.'));
    }

    public function delete(Animal $animal)
    {
        $this->getEm()->remove($animal);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier verwijderd.'));
    }

    public function edit()
    {
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function getActiveState(int $id): Status
    {
        $result = $this->getAnimalRepository()->getActiveState($this->find($id));
        if (is_null($result)) {
            return new Status();
        }

        return $result;
    }

    public function getRepository(): AnimalRepository
    {
        return $this->getAnimalRepository();
    }

    public function validChipnumber(string $chipnumber)
    {
        if (strlen($chipnumber) != 15 || intval($chipnumber) === 0) {
            $this->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, 'Een chipnummer bestaat uit 15 cijfers.'));
            return false;
        }

        return true;
    }

    public function searchChipnumberInternal(int $chipnumber)
    {
        return $this->getRepository()->findOneBy(['chipnumber' => $chipnumber]);
    }

    public function ndgResult(int $chipnumber)
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->request('POST', 'https://ndgnl.secure.is.nl/search.php?loc=nl_NL', [
                'timeout' => 2,
                'form_params' => [
                    'Barcode' => $chipnumber,
                ]
            ]);
        } catch (GuzzleHttp\Exception\ConnectException $connectException) {
            return $connectException->getMessage();
        }

        $result = $response->getBody()->getContents();
        $start = strpos($result, '<table');

        if (strpos($result, 'Diernaam')) {
            return substr($result, $start);
        } else {
            return null;
        }
    }

    public function bhcResult(int $chipnumber)
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'http://particulier.backhomeclub.nl/Info_Chipnummer_nl.aspx', [
                'timeout' => 2,
                'query' => ['chipnummer' => $chipnumber]
            ]);
        } catch (GuzzleHttp\Exception\ConnectException $connectException) {
            return $connectException->getMessage();
        }

        $response = $client->request('GET', 'http://particulier.backhomeclub.nl/Info_Chipnummer_nl.aspx', [
            'timeout' => 2,
            'query' => ['chipnummer' => $chipnumber]
        ]);

        $result = $response->getBody()->getContents();
        $start = strpos($result, '<table id="tableResult"');

        if (strpos($result, 'Uw resultaten')) {
            return substr($result, $start);
        } else {
            return null;
        }
    }

    public function idchipsResult(int $chipnumber)
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->request('POST', 'http://idchips.com/nl/search', [
                'timeout' => 2,
                'form_params' => [
                    'search_identification_number' => $chipnumber,
                ]
            ]);
        } catch (GuzzleHttp\Exception\ConnectException $connectException) {
            return $connectException->getMessage();
        }

        $result = $response->getBody()->getContents();

        $start = strpos($result, '<table width="100%"');

        if (strpos($result, 'Animal')) {
            return substr($result, $start);
        } else {
            return null;
        }
    }
}
