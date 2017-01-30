<?php


namespace Asiel\BackendBundle\Test\EventListener;

use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Asiel\BackendBundle\EventListener\ResourceNotFoundListener;
use Symfony\Bridge\Twig\TwigEngine;

class ResourceNotFoundListenerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $twig = $this->getMockBuilder(TwigEngine::class)
            ->disableOriginalConstructor()
            ->getMock();
        $listener = new ResourceNotFoundListener($twig);
    }

    // exit breaks tests, needs rework
//    public function test_resource_not_found_event()
//    {
//        $twig = $this->getMockBuilder(TwigEngine::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $listener = $this->getMockBuilder(ResourceNotFoundListener::class)
//            ->setMethods(null)
//            ->setConstructorArgs([$twig])
//            ->getMock();
//
//        $event = new ResourceNotFoundEvent('success', 1);
//
//        $listener->onResourceNotFoundEvent($event);
//    }

//    public function test_resource_not_found_event_with_message()
//    {
//        $twig = $this->getMockBuilder(TwigEngine::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $listener = $this->getMockBuilder(ResourceNotFoundListener::class)
//            ->setMethods(null)
//            ->setConstructorArgs([$twig])
//            ->getMock();
//
//        $event = new ResourceNotFoundEvent('success', null);
//
//        $listener->onResourceNotFoundEvent($event);
//    }

}
