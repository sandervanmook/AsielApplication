<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\Shared\Service\BaseFormHandler;

class FoundActionFormHandler extends BaseActionFormHandler
{
    public function __construct(BaseFormHandler $baseFormHandler)
    {
        parent::__construct($baseFormHandler);
    }

    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'Found';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is een nieuwe gevonden status aanmaken momenteel niet mogelijk."));
            return false;
        }

        return true;
    }
}