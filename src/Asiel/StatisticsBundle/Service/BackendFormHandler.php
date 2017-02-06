<?php


namespace Asiel\StatisticsBundle\Service;


use Asiel\AnimalBundle\Repository\AnimalRepository;
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

}