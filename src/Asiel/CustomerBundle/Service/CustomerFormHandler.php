<?php

namespace Asiel\CustomerBundle\Service;

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

    public function getRequestStack() : RequestStack
    {
        return $this->requestStack;
    }

    public function getRepository() : CustomerRepository
    {
        return $this->em->getRepository('CustomerBundle:Customer');
    }

}