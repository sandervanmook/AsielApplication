<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;
use GuzzleHttp;

class AnimalFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    protected function getBaseFormHandler()
    {
        return $this->baseFormHandler;
    }

    public function find(int $animalId): Animal
    {
        return $this->baseFormHandler->findAnimal($animalId);
    }

    public function create(Animal $animal)
    {
        $animal->setAge();
        $this->baseFormHandler->getEm()->persist($animal);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier is aangemaakt.'));
    }

    public function delete(Animal $animal)
    {
        $this->baseFormHandler->getEm()->remove($animal);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier verwijderd.'));
    }

    public function edit(Animal $animal)
    {
        $animal->setAge();
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function getActiveState(int $id): Status
    {
        $result = $this->baseFormHandler->getAnimalRepository()->getActiveState($this->find($id));
        if (is_null($result)) {
            return new Status();
        }

        return $result;
    }

    public function getRepository(): AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }

    public function validChipnumber(int $chipnumber)
    {
        if (strlen($chipnumber) != 15) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
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

        $response = $client->request('POST', 'https://ndgnl.secure.is.nl/search.php?loc=nl_NL', [
            'form_params' => [
                'Barcode' => $chipnumber,
            ]
        ]);

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

        $response = $client->request('GET', 'http://particulier.backhomeclub.nl/Info_Chipnummer_nl.aspx', [
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
}
