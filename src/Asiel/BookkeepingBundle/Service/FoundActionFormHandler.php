<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;

class FoundActionFormHandler
{
    private $baseFormHandler;
    private $totalCosts;

    public function __construct(BaseFormHandler $baseFormHandler, TotalActionCosts $totalCosts)
    {
        $this->baseFormHandler = $baseFormHandler;
        $this->totalCosts = $totalCosts;
    }

    public function getBaseFormHandler()
    {
        return $this->baseFormHandler;
    }

    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'Found';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is een nieuwe gevonden status aanmaken momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function createAction(Animal $animal, Customer $customer, Found $status): Action
    {
        $this->totalCosts->setAnimal($animal);
        $this->totalCosts->setActionType('Found');
        $this->totalCosts->setStatus($status);

        // Create the action
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Found');
        $action->setTotalCosts($this->totalCosts->getTotalCosts());
        $action->setAnimal($animal);
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
        // If we need to deworm the animal, create a task.
        if ($status->needsDeWorm()) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Found::FOUND_DEWORM));
        }
        // If we need to vaccine the animal, create a task.
        if ($status->needsVaccines()) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('createtask',
                new TaskEvent($currentAnimal, Task::TOMORROW, Found::FOUND_VACCINATE));
        }

        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De gevonden status is aangemaakt.'));
    }

    public function verifyFinish(Action $action) : bool
    {
        if ($action->isFullyPaid()) {
            return true;
        }

        return false;
    }

    public function findAnimal(int $animalId) : Animal
    {
        return $this->getBaseFormHandler()->findAnimal($animalId);
    }

    public function findCustomer(int $customerId) : Customer
    {
        return $this->getBaseFormHandler()->findCustomer($customerId);
    }

    public function findAction(int $actionId) : Action
    {
        return $this->getBaseFormHandler()->findAction($actionId);
    }

    public function addExtraCosts(array $formValues, Action $action)
    {
        // Check if costs were already added
        if ($action->getStatus()->isExtraCostsApplied()) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER, 'De extra kosten zijn al toegevoegd.'));

            return;
        }

        $currentTotalCosts = $action->getTotalCosts();

        $bookkeepingSettingsRepository = $this->getBaseFormHandler()->getBookkeepingSettingsRepository();
        $costsPerDay = $bookkeepingSettingsRepository->getSettings()->getPriceFoundTenancyPerDay();

        $tenacyCosts = $formValues['tenancydays'] * $costsPerDay;

        $add = $formValues['sterilization'] +
            $formValues['medical'] +
            $formValues['damage'] +
            $tenacyCosts;

        $newTotalCosts = $currentTotalCosts + $add;
        $action->setTotalCosts($newTotalCosts);
        $action->getStatus()->setExtraCostsApplied(true);

        $this->getBaseFormHandler()->getEm()->flush();

        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De extra kosten zijn toegevoegd.'));
    }
}