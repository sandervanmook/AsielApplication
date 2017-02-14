<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CustomerBundle\Entity\Customer;

class AbandonedActionFormHandler
{
    private $baseActionFormHandler;

    public function __construct(BaseActionFormHandler $baseActionFormHandler)
    {
        $this->baseActionFormHandler = $baseActionFormHandler;
    }

    public function getBaseActionFormHandler() : BaseActionFormHandler
    {
        return $this->baseActionFormHandler;
    }

    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'Abandoned';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is afstaan momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function getTotalActionCosts(Animal $animal): int
    {
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyAKitten())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedKitten();
        }
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyACat())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedCat();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyADog())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedDog();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyAPuppy())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAbandonedPuppy();
        }

        throw new \Exception('No setting available');
    }

    public function createAction(Animal $animal, Customer $customer, int $totalCosts, Status $status): Action
    {
        // Create the action
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Abandoned');
        $action->setTotalCosts($totalCosts);
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);
        $action->setStatus($status);

        // Create the status but don't link it to the animal yet,
        // we will do this when action is finished
        $status->setArchived(true);

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->persist($action);
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->persist($status);

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->flush();

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS,
                "Actie is aangemaakt."));

        return $action;
    }

    public function setNewStatus(Action $action)
    {
        $currentAnimal = $action->getAnimal();
        $status = $action->getStatus();
        $currentCustomer = $action->getCustomer();

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);

        // Archive all states so the new one will be the new active state
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // The new status should be active
        $status->setArchived(false);

        // Set the customer to the status
        $status->setAbandonedBy($currentCustomer);

        // Mark action complete
        $action->setCompleted(true);

        // Handle task creation
        // If we need to chip the animal, create a task.
        if ($status->isNeedsChipping()) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_CHIPPED));
        }
        // If we need to vaccine the animal, create a task.
        if ($status->isNeedsVaccines()) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_VACCINE));
        }
        // If we need to sterilize the animal, create a task.
        if ($status->isNeedsSterilization()) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_STERILIZE));
        }
        // If the animal needs a passport, create a task.
        if ($status->isNeedsPassport()) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Abandoned::ABANDON_PASSPORT));
        }

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->flush();
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De afstand status is aangemaakt.'));
    }
}