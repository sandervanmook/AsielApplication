<?php


namespace Asiel\CalendarBundle\Service;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\Shared\Service\BaseFormHandlerTrait;
use DateInterval;
use DateTime;

class TaskFormHandler
{
    use BaseFormHandlerTrait;

    public function createByEvent(Animal $animal, $dateDue, $origin)
    {
        $task = new Task();

        $date = new DateTime();
        $eventDateDue = $date->add(new DateInterval($dateDue));

        $title = $origin['title'];
        $description = $origin['description'];

        // Create Task
        $task->setDateCreated(new DateTime());
        $task->setDateDue($eventDateDue);
        $task->setTitle($title);
        $task->setDescription($description);
        $task->setIsComplete(false);
        $task->setAnimal($animal);
        $task->setCreatedBy('Systeem');

        // Save in DB
        $this->getEm()->persist($task);
        $this->getEm()->flush();

        // Send alert
        $this->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::INFO, "Taak {$title} is aangemaakt door het systeem."));
    }
}