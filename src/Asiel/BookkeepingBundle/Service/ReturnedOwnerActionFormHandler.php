<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;

class ReturnedOwnerActionFormHandler
{
    private $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'ReturnedOwner';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is terug naar eigenaar momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function getTotalActionCosts(Animal $animal): int
    {
        // Not used for this type of action.
    }

    public function createAction(Animal $animal, Customer $customer, int $totalCosts, Status $status): Action
    {
        // Create the action
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('ReturnedOwner');
        $action->setTotalCosts($totalCosts);
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);
        $action->setStatus($status);

        // Create the status but don't link it to the animal yet,
        // we will do this when action is finished
        $status->setArchived(true);

        $this->baseFormHandler->getEm()->persist($action);
        $this->baseFormHandler->getEm()->persist($status);

        $this->baseFormHandler->getEm()->flush();

        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS,
                "Actie is aangemaakt."));

        return $action;
    }

    public function setNewStatus(Action $action)
    {
        $currentAnimal = $action->getAnimal();
        $status = $action->getStatus();

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);

        // Set owner
        $status->setOwner($action->getCustomer());

        // Archive all states so the new one will be the new active state
        $this->baseFormHandler->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // The new status should be active
        $status->setArchived(false);

        // Mark action complete
        $action->setCompleted(true);

        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De in terug naar eigenaar status is aangemaakt.'));
    }

    public function needCustomerToProceedMessage()
    {
        return $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::DANGER, 'U moet een klant kiezen om door te gaan.'));
    }

    public function verifyFinish(Action $action) : bool
    {
        if ($action->isFullyPaid()) {
            return true;
        }

        return false;
    }

}