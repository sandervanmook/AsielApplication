<?php

namespace Asiel\CustomerBundle\Service;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CustomerBundle\Entity\BusinessCustomer;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Asiel\Shared\Service\BaseFormHandler;
use Symfony\Component\HttpFoundation\RequestStack;

class CustomerFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function findCustomer(int $customerId): Customer
    {
        return $this->baseFormHandler->findCustomer($customerId);
    }

    public function edit()
    {
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function createPrivate(PrivateCustomer $privateCustomer)
    {
        $this->baseFormHandler->getEm()->persist($privateCustomer);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Klant is aangemaakt.'));
    }

    public function createBusiness(BusinessCustomer $businessCustomer)
    {
        $this->baseFormHandler->getEm()->persist($businessCustomer);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Klant is aangemaakt.'));
    }

    public function getRequestStack(): RequestStack
    {
        return $this->baseFormHandler->getRequestStack();
    }

    public function getRepository(): CustomerRepository
    {
        return $this->baseFormHandler->getCustomerRepository();
    }

}