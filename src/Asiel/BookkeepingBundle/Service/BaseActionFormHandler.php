<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;

abstract class BaseActionFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    abstract public function stateChangeAllowed(Animal $animal);

    abstract public function getTotalActionCosts(Animal $animal) : int;

    abstract public function createAction(Animal $animal, Customer $customer, int $totalCosts, Status $status): Action;

    abstract public function setNewStatus(Action $action);

    public function getBaseFormHandler() : BaseFormHandler
    {
        return $this->baseFormHandler;
    }

    public function findAnimal(int $animalId): Animal
    {
        return $this->baseFormHandler->findAnimal($animalId);
    }

    public function findCustomer(int $customerId): Customer
    {
        return $this->baseFormHandler->findCustomer($customerId);
    }

    public function findAction(int $actionId): Action
    {
        return $this->baseFormHandler->findAction($actionId);
    }

    public function getAnimalType(Animal $animal) : string
    {
        if ($animal->getClassName() == 'Cat') {
            return $animal->getCurrentCatType();
        }
        if ($animal->getClassName() == 'Dog') {
            return $animal->getCurrentDogType();
        }
    }

    public function verifyFinish(Action $action) : bool
    {
        if ($action->isFullyPaid()) {
            return true;
        }

        return false;
    }

    public function needCustomerToProceedMessage()
    {
        return $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::DANGER, 'U moet een klant kiezen om door te gaan.'));
    }

}