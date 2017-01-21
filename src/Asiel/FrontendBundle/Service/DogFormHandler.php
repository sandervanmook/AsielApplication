<?php


namespace Asiel\FrontendBundle\Service;


use Asiel\AnimalBundle\Repository\AnimalType\DogRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class DogFormHandler
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
     * @param $option string
     * @return array
     */
    public function dogsOption($option)
    {
        $possibleOptions = ['dog', 'puppy', 'both'];

        if (!in_array($option, $possibleOptions)) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Option', null));
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

    /**
     * @param $id integer
     * @return Dog
     */
    public function findDog(int $id)
    {
        $dog = $this->getDogRepository()->find($id);

        if (!$dog) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Hond', $id));
        }

        return $dog;
    }

    public function getDogRepository(): DogRepository
    {
        return $this->em->getRepository('AnimalBundle:AnimalType\Dog');
    }

}