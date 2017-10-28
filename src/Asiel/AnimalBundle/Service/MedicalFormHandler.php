<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\MedicalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandlerTrait;

class MedicalFormHandler
{
    use BaseFormHandlerTrait {
        // Resolve naming conflict
        getAnimalRepository as AnimalRepository;
    }
    
    public function find(int $medicalId)
    {
        return $this->findMedical($medicalId);
    }

    public function create(Medical $medical, int $animalId)
    {
        $animal = $this->getAnimalRepository()->find($animalId);
        $medical->setAnimal($animal);
        $this->getEm()->persist($medical);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier aangemaakt.'));
    }

    public function delete(Medical $medical)
    {
        $this->getEm()->remove($medical);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier verwijderd.'));
    }

    public function getRepository() : MedicalRepository
    {
        return $this->getMedicalRepository();
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->AnimalRepository();
    }
}