<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ActionFormHandler
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

    public function findAnimal(int $animalId) : Animal
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    public function hasOpenActionsMessage()
    {
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::DANGER,
            "U kunt geen nieuwe actie starten voordat de vorige is afgerond."));
    }

    public function findAction(int $actionId) : Action
    {
        $action = $this->em->getRepository('BookkeepingBundle:Action')->find($actionId);

        if (!$action) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Actie', $actionId));
        }

        return $action;
    }

}