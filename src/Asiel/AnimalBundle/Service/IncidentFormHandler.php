<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\IncidentRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;

class IncidentFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $incidentId) : Incident
    {
        return $this->baseFormHandler->findIncident($incidentId);
    }

    public function create(Incident $incident, int $animalId)
    {
        $animal = $this->getAnimalRepository()->find($animalId);
        $incident->setAnimal($animal);
        $this->baseFormHandler->getEm()->persist($incident);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Het incident is aangemaakt.'));
    }

    public function delete(Incident $incident)
    {
        $this->baseFormHandler->getEm()->remove($incident);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Incident verwijderd.'));
    }

    public function getRepository(): IncidentRepository
    {
        return $this->baseFormHandler->getIncidentRepository();
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }
}