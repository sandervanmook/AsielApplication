<?php


namespace Asiel\StatisticsBundle\Service;


use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\StatusRepository;
use Asiel\AnimalBundle\Repository\StatusType\AbandonedRepository;
use Asiel\AnimalBundle\Repository\StatusType\AdoptedRepository;
use Asiel\AnimalBundle\Repository\StatusType\FoundRepository;
use Asiel\AnimalBundle\Repository\StatusType\ReturnedOwnerRepository;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class BackendFormHandler
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

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }

    public function getCustomerRepository() : CustomerRepository
    {
        return $this->em->getRepository('CustomerBundle:Customer');
    }

    public function getStatusRepository() : StatusRepository
    {
        return $this->em->getRepository('AnimalBundle:Status');
    }

    public function getAdoptedStatusRepository() : AdoptedRepository
    {
        return $this->em->getRepository('AnimalBundle:StatusType\Adopted');
    }

    public function getAbandonedStatusRepository() : AbandonedRepository
    {
        return $this->em->getRepository('AnimalBundle:StatusType\Abandoned');
    }

    public function getFoundStatusRepository() : FoundRepository
    {
        return $this->em->getRepository('AnimalBundle:StatusType\Found');
    }

    public function getReturnedOwnerStatusRepository() : ReturnedOwnerRepository
    {
        return $this->em->getRepository('AnimalBundle:StatusType\ReturnedOwner');
    }
}