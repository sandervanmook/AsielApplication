<?php


namespace Asiel\CalendarBundle\Test\Event;


use Asiel\CalendarBundle\Event\TaskEvent;

class TaskEventTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $event = new TaskEvent('P1D', ['title' => 'Hi', 'description' => 'yolo']);
    }

    public function test_get_date_due()
    {
        $event = new TaskEvent('P1D', ['title' => 'Hi', 'description' => 'yolo']);
        $this->assertEquals($event->getDateDue(), 'P1D');
    }

    public function test_get_origin()
    {
        $event = new TaskEvent('P1D', ['title' => 'Hi', 'description' => 'yolo']);
        $this->assertEquals($event->getOrigin(), ['title' => 'Hi', 'description' => 'yolo']);
    }
}
