<?php


namespace Asiel\StatisticsBundle\Service;

use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\AnimalBundle\Repository\AnimalType\CatRepository;
use Asiel\AnimalBundle\Repository\StatusRepository;
use Asiel\AnimalBundle\Repository\StatusType\AbandonedRepository;
use Asiel\AnimalBundle\Repository\StatusType\AdoptedRepository;
use Asiel\AnimalBundle\Repository\StatusType\FoundRepository;
use Asiel\AnimalBundle\Repository\StatusType\ReturnedOwnerRepository;
use Asiel\CustomerBundle\Repository\CustomerRepository;
use Asiel\Shared\Service\BaseFormHandler;

class BackendFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function getAnimalRepository() : AnimalRepository
    {
        return $this->baseFormHandler->getAnimalRepository();
    }

    public function getCustomerRepository() : CustomerRepository
    {
        return $this->baseFormHandler->getCustomerRepository();
    }

    public function getStatusRepository() : StatusRepository
    {
        return $this->baseFormHandler->getStatusRepository();
    }

    public function getAdoptedStatusRepository() : AdoptedRepository
    {
        return $this->baseFormHandler->getEm()->getRepository('AnimalBundle:StatusType\Adopted');
    }

    public function getAbandonedStatusRepository() : AbandonedRepository
    {
        return $this->baseFormHandler->getEm()->getRepository('AnimalBundle:StatusType\Abandoned');
    }

    public function getFoundStatusRepository() : FoundRepository
    {
        return $this->baseFormHandler->getEm()->getRepository('AnimalBundle:StatusType\Found');
    }

    public function getReturnedOwnerStatusRepository() : ReturnedOwnerRepository
    {
        return $this->baseFormHandler->getEm()->getRepository('AnimalBundle:StatusType\ReturnedOwner');
    }

    public function getCatRepository() : CatRepository
    {
        return $this->baseFormHandler->getCatRepository();
    }
}