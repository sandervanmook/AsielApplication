<?php


namespace Asiel\AnimalBundle\Test\Service;


use Asiel\AnimalBundle\Service\AnimalFormHandler;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AnimalFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $eventDispatcher = $this->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requeststack = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new AnimalFormHandler($em, $eventDispatcher, $requeststack);
    }

}
