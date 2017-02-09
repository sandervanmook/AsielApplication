<?php

namespace Asiel\AnimalBundle\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Repository\AnimalRepository;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AnimalFormHandler
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
     * @param int $animalId
     * @return Animal|null
     */
    public function find(int $animalId)
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    public function create(Animal $animal)
    {
        $animal->setAge();
        $this->em->persist($animal);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier is aangemaakt.'));
    }

    public function delete(Animal $animal)
    {
        $this->em->remove($animal);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Dier verwijderd.'));
    }

    /**
     * @param Animal $animal
     */
    public function edit(Animal $animal)
    {
        $animal->setAge();
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    /**
     * @param integer $id
     * @return Status
     */
    public function getActiveState(int $id)
    {
        $result = $this->em->getRepository('AnimalBundle:Animal')->getActiveState($this->find($id));
        if (is_null($result)) {
            return new Status();
        }

        return $result;
    }

    public function getRepository() : AnimalRepository
    {
        return $this->em->getRepository('AnimalBundle:Animal');
    }
}
