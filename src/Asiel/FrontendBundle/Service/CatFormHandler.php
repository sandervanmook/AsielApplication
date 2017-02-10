<?php


namespace Asiel\FrontendBundle\Service;


use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Repository\AnimalType\CatRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\Shared\Service\BaseFormHandler;

class CatFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    public function catsOption(string $option)
    {
        $possibleOptions = ['cat', 'kitten', 'both'];

        if (!in_array($option, $possibleOptions)) {
            $this->baseFormHandler->getEventDispatcher()->dispatch('resourcenotfound',
                new ResourceNotFoundEvent('Option', null));
        }

        switch ($option) {
            case 'both':
                return $this->getCatRepository()->findAllOnsite(2);
                break;
            case 'cat':
                return $this->getCatRepository()->findAllOnsite(1);
                break;
            case 'kitten':
                return $this->getCatRepository()->findAllOnsite(0);
                break;
        }
    }

    public function getCatRepository(): CatRepository
    {
        return $this->baseFormHandler->getCatRepository();
    }

    public function findCat(int $catId) : Cat
    {
        return $this->baseFormHandler->findCat($catId);
    }
}