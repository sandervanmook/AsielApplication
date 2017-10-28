<?php


namespace Asiel\AnimalBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\Shared\Service\BaseFormHandlerTrait;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class TaskFormHandler
{
    use BaseFormHandlerTrait{
        // Resolve naming conflict
        findAnimal as findAnimalTrait;
    }

    protected $em;
    protected $eventDispatcher;
    protected $requestStack;
    protected $tokenStorage;

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
        return $this->findAnimalTrait($animalId);
    }

    public function find(int $taskId): Task
    {
        return $this->findTask($taskId);
    }

    public function edit()
    {
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function delete(Task $task)
    {
        $this->getEm()->remove($task);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Taak verwijderd.'));
    }

    public function createByForm(Task $task, int $animalId)
    {
        $animal = $this->findAnimal($animalId);
        $task->setAnimal($animal);
        $task->setCreatedBy($this->tokenStorage->getToken()->getUsername());
        $this->getEm()->persist($task);
        $this->getEm()->flush();
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De taak is aangemaakt.'));
    }

}