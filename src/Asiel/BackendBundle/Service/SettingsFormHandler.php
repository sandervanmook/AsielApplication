<?php


namespace Asiel\BackendBundle\Service;


use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SettingsFormHandler
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

    public function edit()
    {
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Wijziging opgeslagen.'));
    }

}