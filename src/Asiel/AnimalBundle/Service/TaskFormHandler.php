<?php


namespace Asiel\AnimalBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class TaskFormHandler
{
    protected $em;
    protected $eventDispatcher;
    protected $requestStack;

    public function __construct(
        EntityManager $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack,
        TokenStorage $tokenStorage
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
    }

    public function findAnimal(int $animalId): Animal
    {
        $animal = $this->em->getRepository('AnimalBundle:Animal')->find($animalId);

        if (!$animal) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Dier', $animalId));
        }

        return $animal;
    }

    /**
     * @param int $taskId
     * @return Task|null
     */
    public function find(int $taskId)
    {
        $task = $this->em->getRepository('CalendarBundle:Task')->find($taskId);

        if (!$task) {
            $this->eventDispatcher->dispatch('resourcenotfound', new ResourceNotFoundEvent('Taak', $taskId));
        }

        return $task;
    }

    public function edit()
    {
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    /**
     * @param Task $task
     */
    public function delete(Task $task)
    {
        $this->em->remove($task);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Taak verwijderd.'));
    }

    /**
     * @param Task $task
     * @param integer $animalId
     */
    public function createByForm(Task $task, int $animalId)
    {
        $animal = $this->findAnimal($animalId);
        $task->setAnimal($animal);
        $task->setCreatedBy($this->tokenStorage->getToken()->getUsername());
        $this->em->persist($task);
        $this->em->flush();
        $this->eventDispatcher->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De taak is aangemaakt.'));
    }

}