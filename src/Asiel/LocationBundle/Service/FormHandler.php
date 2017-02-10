<?php

namespace Asiel\LocationBundle\Service;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\LocationBundle\Entity\Location;
use Asiel\Shared\Service\BaseFormHandler;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

class FormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function find(int $locationId): Location
    {
        return $this->baseFormHandler->findLocation($locationId);
    }

    public function create(Location $location)
    {
        $this->baseFormHandler->getEm()->persist($location);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Locatie is aangemaakt.'));
    }

    public function delete(Location $location)
    {
        $this->baseFormHandler->getEm()->remove($location);

        try {
            $this->baseFormHandler->getEm()->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    'Locatie kan niet worden verwijderd, er zitten nog dieren aan gekoppeld.'));
            exit;
        }
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Locatie verwijderd'));
    }
}
