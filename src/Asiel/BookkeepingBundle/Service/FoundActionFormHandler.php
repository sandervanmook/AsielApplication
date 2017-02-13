<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CustomerBundle\Entity\Customer;
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

    public function getTotalActionCosts(Animal $animal): int
    {
        // Not used in this action type
    }

    public function createAction(Animal $animal, Customer $customer, int $totalCosts, Status $status): Action
    {
        // Create the action
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Found');
        $action->setTotalCosts($totalCosts); // 0 at the moment
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        if (!is_null($customer->getId())) {
            $action->setCustomer($customer); // null if none selected
        }
        $action->setStatus($status);

        // We will set the state active when action is complete.
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

        // Archive all states so the new one will be the new active state
        $this->baseFormHandler->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // The new status should be active
        $status->setArchived(false);

        // Mark action complete
        $action->setCompleted(true);

        // Create reminder checkup task
        $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
            new TaskEvent($currentAnimal, Task::THREEDAYS, Found::FOUND_CHECKUP));

        // Create available for adoption task.
        $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
            new TaskEvent($currentAnimal, Task::FIFTEENDAYS, Found::FOUND_AVAILABLE));

        // Set the customer who found the animal.
        if (!is_null($action->getCustomer())) {
            $status->setFoundBy($action->getCustomer());
        }

        // If we need to chip the animal, create a task.
        if ($status->isNeedsChipping()) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Found::FOUND_CHIPPED));
        }

        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De gevonden status is aangemaakt.'));
    }
}