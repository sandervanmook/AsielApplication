<?php

namespace Asiel\LocationBundle\Service;

use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\LocationBundle\Entity\Location;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em               = $em;
        $this->eventDispatcher  = $eventDispatcher;
        $this->requestStack     = $requestStack;
    }

    public function find(int $locationId)
    {
        $location = $this->em->getRepository('LocationBundle:Location')->find($locationId);

        if (!$location) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Locatie', $locationId));
        }

        return $location;
    }

    public function create(Location $location)
    {
        $this->em->persist($location);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Locatie is aangemaakt.'));
    }

    public function delete(Location $object)
    {
        $this->em->remove($object);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Locatie verwijderd.'));
    }
}
