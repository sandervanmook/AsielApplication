<?php


namespace Asiel\FrontendBundle\Service;


use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Repository\AnimalType\DogRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\Shared\Service\BaseFormHandler;


class DogFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function dogsOption(string $option)
    {
        $possibleOptions = ['dog', 'puppy', 'both'];

        if (!in_array($option, $possibleOptions)) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Option', null));
        }

        switch ($option) {
            case 'both':
                return $this->getDogRepository()->findAllOnsite(2);
                break;
            case 'dog':
                return $this->getDogRepository()->findAllOnsite(1);
                break;
            case 'puppy':
                return $this->getDogRepository()->findAllOnsite(0);
                break;
        }
    }

    public function findDog(int $dogId) : Dog
    {
        return $this->baseFormHandler->findDog($dogId);
    }

    public function getDogRepository(): DogRepository
    {
        return $this->baseFormHandler->getDogRepository();
    }

}