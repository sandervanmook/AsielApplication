<?php


namespace Asiel\FrontendBundle\Service;


use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Repository\AnimalType\CatRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CatFormHandler
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
    public function catsOption(string $option)
    {
        $possibleOptions = ['cat', 'kitten', 'both'];

        if (!in_array($option, $possibleOptions)) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Option', null));
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

    public function getCatRepository() : CatRepository
    {
        return $this->em->getRepository('AnimalBundle:AnimalType\Cat');
    }

    /**
     * @param $id integer
     * @return Cat|null
     */
    public function findCat(int $id)
    {
        $cat = $this->getCatRepository()->find($id);

        if (!$cat) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Kat', $id));
        }

        return $cat;
    }
}