<?php


namespace Asiel\BackendBundle\Test\Event;


use Asiel\BackendBundle\Event\ResourceNotFoundEvent;

class ResourceNotFoundEventTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $event = new ResourceNotFoundEvent('yolo', 1);
    }

    public function test_get_type()
    {
        $event = new ResourceNotFoundEvent('yolo', 1);
        $this->assertEquals($event->getType(), 'yolo');
    }

    public function test_get_id()
    {
        $event = new ResourceNotFoundEvent('yolo', 1);
        $this->assertEquals($event->getId(), '1');
    }
}
