<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\MedicalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;

class MedicalFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $medicalId)
    {
        return $this->baseFormHandler->findMedical($medicalId);
    }

    public function create(Medical $medical, int $animalId)
    {
        $animal = $this->baseFormHandler->getAnimalRepository()->find($animalId);
        $medical->setAnimal($animal);
        $this->baseFormHandler->getEm()->persist($medical);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier aangemaakt.'));
    }

    public function delete(Medical $medical)
    {
        $this->baseFormHandler->getEm()->remove($medical);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier verwijderd.'));
    }

    public function getRepository() : MedicalRepository
    {
        return $this->baseFormHandler->getMedicalRepository();
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }
}