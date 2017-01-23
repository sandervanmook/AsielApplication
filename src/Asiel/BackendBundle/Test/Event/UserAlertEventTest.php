<?php


namespace Asiel\BackendBundle\Test\Event;


use Asiel\BackendBundle\Event\UserAlertEvent;

class UserAlertEventTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $event = new UserAlertEvent('success');
    }

    /**
     * @expectedException \Exception
     */
    public function test_it_throws_on_unknown_type()
    {
        $event = new UserAlertEvent('yolo');
    }

    public function test_get_type()
    {
        $event = new UserAlertEvent('success');
        $this->assertEquals($event->getType(), 'success');
    }

    public function test_get_message()
    {
        $event = new UserAlertEvent('success', 'message');
        $this->assertEquals($event->getMessage(), 'message');
    }

    public function test_get_data()
    {
        $event = new UserAlertEvent('success', 'message', ['some data']);
        $this->assertEquals($event->getdata(), ['some data']);
    }
}
