<?php

namespace Asiel\CalendarBundle\EventListener;


use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CalendarBundle\Service\TaskFormHandler;

class TaskListener
{
    private $taskFormHandler;

    public function __construct(TaskFormHandler $taskFormHandler)
    {
        $this->taskFormHandler = $taskFormHandler;
    }

    /**
     * @param TaskEvent $event
     */
    public function onCreateTaskEvent(TaskEvent $event)
    {
        $animal = $event->getAnimal();
        $dateDue = $event->getDateDue();
        $origin  = $event->getOrigin();

        $this->taskFormHandler->createByEvent($animal, $dateDue, $origin);
    }
}