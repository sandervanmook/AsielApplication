<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\StatusRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AdoptedActionFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
    }

    /**
     * @param Animal $animal
     * @return bool
     */
    public function stateChangeAllowed(Animal $animal)
    {
        $stateMachine = new AnimalStateMachine();
        $stateMachine->setAnimal($animal);
        $changeToState = 'changeTo' . 'Adopted';
        $decision = call_user_func([$stateMachine, $changeToState]);

        //TODO translate current state
        if (!$decision) {
            $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::DANGER,
                "Vanwege de huidige status van dit dier ({$animal->getActiveState()}) is adoptie momenteel niet mogelijk."));
            return false;
        }

        return true;
    }

    public function findAnimal(int $animalId)
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    public function findCustomer(int $customerId)
    {
        $customer = $this->em->getRepository('CustomerBundle:Customer')->find($customerId);

        if (!$customer) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Klant', $customerId));
        }

        return $customer;
    }

    public function getTotalActionCosts(Animal $animal)
    {
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyAKitten())) {
            return $this->getBookkeepingSettginsRepository()->getSettings()->getPriceAdoptedKitten();
        }
        if (($animal->getClassName() == 'Cat') && ($animal->isCurrentlyACat())) {
            return $this->getBookkeepingSettginsRepository()->getSettings()->getPriceAdoptedCat();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyADog())) {
            return $this->getBookkeepingSettginsRepository()->getSettings()->getPriceAdoptedDog();
        }
        if (($animal->getClassName() == 'Dog') && ($animal->isCurrentlyAPuppy())) {
            return $this->getBookkeepingSettginsRepository()->getSettings()->getPriceAdoptedPuppy();
        }
    }

    public function getAnimalType(Animal $animal)
    {
        if ($animal->getClassName() == 'Cat') {
            return $animal->getCurrentCatType();
        }
        if ($animal->getClassName() == 'Dog') {
            return $animal->getCurrentDogType();
        }
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    public function getBookkeepingSettginsRepository() : BookkeepingSettingsRepository
    {
        return $this->em->getRepository('BackendBundle:BookkeepingSettings');
    }

    public function createAction(Animal $animal, Customer $customer, int $totalCosts) : Action
    {
        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Adopted');
        $action->setTotalCosts($totalCosts);
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);

        $this->em->persist($action);
        $this->em->flush();

        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS,
            "Actie is aangemaakt."));

        return $action;
    }

    public function findAction(int $actionId) : Action
    {
        $action = $this->em->getRepository('BookkeepingBundle:Action')->find($actionId);

        if (!$action) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Actie', $actionId));
        }

        return $action;
    }

    public function verifyFinish(Action $action)
    {
        if ($action->isFullyPaid()) {
            return true;
        }

        return false;
    }

    public function setNewStatus(Action $action)
    {
        $currentAnimal = $action->getAnimal();
        $status = new Adopted(new AnimalStateMachine());

        // Set mandatory fields
        $status->setDate(new DateTime('now'));

        // Archive all states so the new one will be the new active state
        $this->getStatusRepository()->setStatesArchived($currentAnimal->getStatus());

        // Bind the animal to this status
        $status->setAnimal($currentAnimal);
        // The new status should be active
        $status->setArchived(false);

        // Set the customer to the status
        $status->setCustomer($action->getCustomer());

        // Mark action complete
        $action->setCompleted(true);

        $this->em->persist($status);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De adoptie status is aangemaakt.'));
    }

    private function getStatusRepository() : StatusRepository
    {
        return $this->em->getRepository('AnimalBundle:Status');
    }

}