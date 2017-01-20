<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\IncidentRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class IncidentFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
    }

    public function find(int $incidentId)
    {
        $incident = $this->em->getRepository('AnimalBundle:Incident')->find($incidentId);

        if (!$incident) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Incident', $incidentId));
        }

        return $incident;
    }

    public function create(Incident $incident, int $animalId)
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);
        $incident->setAnimal($animal);
        $this->em->persist($incident);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Het incident is aangemaakt.'));
    }


    public function getRepository() : IncidentRepository
    {
        return $this->em->getRepository('AnimalBundle:Incident');
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }


}