<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CustomerBundle\Entity\Customer;
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
        $action->setCustomer($customer);

        $this->em->persist($action);
        $this->em->flush();

        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS,
            "Actie is aangemaakt."));

        return $action;
    }

}