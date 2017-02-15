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
use DateTime;

class AdoptedActionFormHandler
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
        $changeToState = 'changeTo' . 'Adopted';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
                new UserAlertEvent(UserAlertEvent::DANGER,
                    "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is adoptie momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function getTotalActionCosts(Animal $animal): int
    {
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyAKitten())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedKitten();
        }
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyACat())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedCat();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyADog())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedDog();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyAPuppy())) {
            return $this->getBaseActionFormHandler()->getBaseFormHandler()->getBookkeepingSettingsRepository()->getSettings()->getPriceAdoptedPuppy();
        }
    }

    public function getAnimalRepository(): AnimalRepository
    {
        return $this->getBaseActionFormHandler()->getBaseFormHandler()->getAnimalRepository();
    }

    public function createAction(Animal $animal, Customer $customer, int $totalCosts, Status $status): Action
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setTotalCosts($totalCosts);
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->persist($action);
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->flush();

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
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
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);
        // The new status should be active
        $status->setArchived(false);

        // Set the customer to the status
        $status->setCustomer($action->getCustomer());

        // Mark action complete
        $action->setCompleted(true);

        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->persist($status);
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEm()->flush();
        $this->getBaseActionFormHandler()->getBaseFormHandler()->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De adoptie status is aangemaakt.'));
    }
}