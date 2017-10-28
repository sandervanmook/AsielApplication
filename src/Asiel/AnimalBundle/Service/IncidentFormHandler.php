<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\IncidentRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandlerTrait;

class IncidentFormHandler
{
    use BaseFormHandlerTrait {
        // Resolve naming conflict
        getAnimalRepository as AnimalRepository;
    }

    public function find(int $incidentId) : Incident
    {
        return $this->findIncident($incidentId);
    }

    public function create(Incident $incident, int $animalId)
    {
        $animal = $this->getAnimalRepository()->find($animalId);
        $incident->setAnimal($animal);
        $this->getEm()->persist($incident);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Het incident is aangemaakt.'));
    }

    public function delete(Incident $incident)
    {
        $this->getEm()->remove($incident);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Incident verwijderd.'));
    }

    public function getRepository(): IncidentRepository
    {
        return $this->getIncidentRepository();
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->AnimalRepository();
    }
}