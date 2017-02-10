<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;

class AnimalFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $animalId) : Animal
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

    public function getActiveState(int $id) : Status
    {
        $result = $this->baseFormHandler->getAnimalRepository()->getActiveState($this->find($id));
        if (is_null($result)) {
            return new Status();
        }

        return $result;
    }

    public function getRepository() : AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }
}
