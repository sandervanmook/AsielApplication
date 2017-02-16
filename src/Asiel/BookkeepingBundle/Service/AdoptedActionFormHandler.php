<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;

class AdoptedActionFormHandler
{
    private $baseFormHandler;
    private $totalCosts;

    public function __construct(BaseFormHandler $baseFormHandler, TotalCosts $totalCosts)
    {
        $this->baseFormHandler = $baseFormHandler;
        $this->totalCosts = $totalCosts;
    }

    public function getBaseFormHandler() : BaseFormHandler
    {
        return $this->baseFormHandler;
    }

    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'Adopted';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is adoptie momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->getBaseFormHandler()->getAnimalRepository();
    }

    public function createAction(Animal $animal, Customer $customer, Status $status): Action
    {
        $this->totalCosts->setAnimal($animal);
        $this->totalCosts->setActionType('Adopted');
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setTotalCosts($this->totalCosts->getTotalCosts());
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);

        $this->getBaseFormHandler()->getEm()->persist($action);
        $this->getBaseFormHandler()->getEm()->flush();

        $this->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS,
                "Actie is aangemaakt."));

        return $action;
    }

    public function setNewStatus(Action $action)
    {
        $currentAnimal = $action->getAnimal();
        $status = new Adopted(new AnimalStateMachine());

        // Set mandatory fields
        $status->setDate(new DateTime('now'));

        // Archive all states so the new one will be the new active state
        $this->getBaseFormHandler()->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);
        // The new status should be active
        $status->setArchived(false);

        // Set the customer to the status
        $status->setCustomer($action->getCustomer());

        // Mark action complete
        $action->setCompleted(true);

        $this->getBaseFormHandler()->getEm()->persist($status);
        $this->getBaseFormHandler()->getEm()->flush();
        $this->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De adoptie status is aangemaakt.'));
    }

    public function findAnimal(int $animalId) : Animal
    {
        return $this->getBaseFormHandler()->findAnimal($animalId);
    }

    public function findCustomer(int $customerId) : Customer
    {
        return $this->getBaseFormHandler()->findCustomer($customerId);
    }

    public function getAnimalType(Animal $animal)
    {
        return $this->getBaseFormHandler()->getAnimalType($animal);
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