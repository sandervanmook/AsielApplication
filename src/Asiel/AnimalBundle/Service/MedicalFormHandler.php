<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\MedicalRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MedicalFormHandler
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

    /**
     * @param int $incidentId
     * @return Incident|null
     */
    public function find(int $incidentId)
    {
        $incident = $this->em->getRepository('AnimalBundle:Medical')->find($incidentId);

        if (!$incident) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Medisch dossier', $incidentId));
        }

        return $incident;
    }

    public function create(Medical $medical, int $animalId)
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);
        $medical->setAnimal($animal);
        $this->em->persist($medical);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier aangemaakt.'));
    }

    public function delete(Medical $medical)
    {
        $this->em->remove($medical);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Medisch dossier verwijderd.'));
    }

    public function getRepository() : MedicalRepository
    {
        return $this->em->getRepository('AnimalBundle:Medical');
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }


}