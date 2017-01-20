<?php

namespace Asiel\BackendBundle\EventListener;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Symfony\Component\HttpFoundation\Session\Session;

class UserAlertListener
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param UserAlertEvent $event
     */
    public function onUserAlertEvent(UserAlertEvent $event)
    {
        $type       = $event->getType();
        $message    = $event->getMessage();
        $data       = $event->getData();

        if ($type == UserAlertEvent::NOSTATE) {
            $this->addNoStateMessage($data);
        }

        $this->addMessage($type, $message);
    }

    /* Messages to user */
    private function addMessage($type, $message)
    {
        $this->session->getFlashBag()->add($type, $message);
    }

    private function addNoStateMessage($data)
    {
        $amount = $data['amount'];
        if ($amount == 1) {
            return $this->session->getFlashBag()->add('danger', 'Er is een dier zonder status.');
        } else {
            return $this->session->getFlashBag()->add('danger', 'Er zijn dieren zonder status. ('.$amount.')');
        }
    }
}
