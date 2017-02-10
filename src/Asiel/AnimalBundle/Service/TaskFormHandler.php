<?php


namespace Asiel\AnimalBundle\Service;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\Shared\Service\BaseFormHandler;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class TaskFormHandler
{
    protected $baseFormHandler;
    protected $tokenStorage;

    public function __construct(
        BaseFormHandler $baseFormHandler,
        TokenStorage $tokenStorage
    ) {
        $this->baseFormHandler = $baseFormHandler;
        $this->tokenStorage = $tokenStorage;
    }

    public function findAnimal(int $animalId): Animal
    {
        return $this->baseFormHandler->findAnimal($animalId);
    }

    public function find(int $taskId): Task
    {
        return $this->baseFormHandler->findTask($taskId);
    }

    public function edit()
    {
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De wijziging is opgeslagen.'));
    }

    public function delete(Task $task)
    {
        $this->baseFormHandler->getEm()->remove($task);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'Taak verwijderd.'));
    }

    public function createByForm(Task $task, int $animalId)
    {
        $animal = $this->findAnimal($animalId);
        $task->setAnimal($animal);
        $task->setCreatedBy($this->tokenStorage->getToken()->getUsername());
        $this->baseFormHandler->getEm()->persist($task);
        $this->baseFormHandler->getEm()->flush();
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::SUCCESS, 'De taak is aangemaakt.'));
    }

}