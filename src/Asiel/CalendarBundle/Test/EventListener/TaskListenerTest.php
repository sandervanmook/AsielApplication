<?php


namespace Asiel\CalendarBundle\Test\EventListener;


use Asiel\AnimalBundle\Entity\Animal;
use Asiel\CalendarBundle\Event\TaskEvent;
use Asiel\CalendarBundle\EventListener\TaskListener;
use Asiel\CalendarBundle\Service\TaskFormHandler;

class TaskListenerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $taskManager = $this->getMockBuilder(TaskFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $listener = new TaskListener($taskManager);
    }

    public function test_on_create_task_event()
    {
        $taskManager = $this->getMockBuilder(TaskFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $listener = new TaskListener($taskManager);

        $event = new TaskEvent(new Animal(),'P1D', []);
        $listener->onCreateTaskEvent($event);
    }


}
