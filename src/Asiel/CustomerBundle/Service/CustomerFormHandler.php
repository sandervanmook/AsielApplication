<?php

namespace Asiel\CustomerBundle\Service;

use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CustomerFormHandler
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
     * @param int $customerId
     * @return Customer|null
     */
    public function find(int $customerId)
    {
        $customer = $this->em->getRepository('CustomerBundle:Customer')->find($customerId);

        if (!$customer) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Klant', $customerId));
        }

        return $customer;
    }

    public function edit()
    {
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function create(Customer $customer)
    {
        $this->em->persist($customer);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message', new UserAlertEvent(UserAlertEvent::SUCCESS, 'Klant is aangemaakt.'));
    }

    public function getRequestStack() : RequestStack
    {
        return $this->requestStack;
    }

    public function getRepository() : CustomerRepository
    {
        return $this->em->getRepository('CustomerBundle:Customer');
    }

}