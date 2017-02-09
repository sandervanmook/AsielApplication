<?php


namespace Asiel\BookkeepingBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\CustomerBundle\Entity\Customer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TransactionFormHandler
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

    public function findAnimal(int $animalId) : Animal
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    public function findAction(int $actionId) : Action
    {
        $action = $this->em->getRepository('BookkeepingBundle:Action')->find($actionId);

        if (!$action) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Actie', $actionId));
        }

        return $action;
    }

    public function findCustomer(int $customerId) : Customer
    {
        $customer = $this->em->getRepository('CustomerBundle:Customer')->find($customerId);

        if (!$customer) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Klant', $customerId));
        }

        return $customer;
    }

    public function create(Action $action, Customer $customer, Transaction $transaction)
    {
        // Is action fully paid ?
        $result = $action->sumRemaining() - $transaction->getPaidAmount();
        if ($result == 0) {
            // Mark action complete
            $action->setFullyPaid(true);
        }

        $transaction->setCustomer($customer);
        $transaction->setAction($action);

        $this->em->persist($transaction);
        $this->em->flush();

        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS,
            "Transactie aangemaakt."));

    }
}