<?php


namespace Asiel\CalendarBundle\Service;

use Asiel\BackendBundle\Event\UserAlertEvent;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\Shared\Service\BaseFormHandler;
use DateInterval;
use DateTime;

class TaskFormHandler
{
    protected $baseFormHandler;

    public function __construct(BaseFormHandler $baseFormHandler)
    {
        $this->baseFormHandler = $baseFormHandler;
    }

    /**
     * @param string $dateDue
     * @param string $origin
     */
    public function createByEvent($dateDue, $origin)
    {
        $task = new Task();
        $animal = $this->baseFormHandler->findAnimal($this->baseFormHandler->getRequestId());

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
        $this->baseFormHandler->getEm()->persist($task);
        $this->baseFormHandler->getEm()->flush();

        // Send alert
        $this->baseFormHandler->getEventDispatcher()->dispatch('user_alert.message',
            new UserAlertEvent(UserAlertEvent::INFO, "Taak {$title} is aangemaakt door het systeem."));
    }
}