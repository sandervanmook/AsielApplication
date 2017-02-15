<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\Shared\Service\BaseFormHandler;

class ActionFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function getBaseFormHandler()
    {
        return $this->baseFormHandler;
    }

    public function findAnimal(int $animalId): Animal
    {
        return $this->getBaseFormHandler()->findAnimal($animalId);
    }

    public function hasOpenActionsMessage()
    {
        $this->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::DANGER,
                "U kunt geen nieuwe actie starten voordat de vorige is afgerond."));
    }

    public function findAction(int $actionId): Action
    {
        return $this->getBaseFormHandler()->findAction($actionId);
    }
}