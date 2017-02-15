<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\BookkeepingBundle\Service\ActionFormHandler;
use Asiel\Shared\Service\BaseFormHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class ActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler = new ActionFormHandler($baseFormHandler);
    }

    public function test_get_base_form_handler()
    {
        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler = new ActionFormHandler($baseFormHandler);

        $handler->getBaseFormHandler();
    }

    public function test_find_animal()
    {
        $handler = $this->getMockBuilder(ActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getbaseformhandler'])
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['findAnimal'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('findAnimal');

        $handler->findAnimal(1);
    }

    public function test_has_open_actions_message()
    {
        $handler = $this->getMockBuilder(ActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getbaseformhandler'])
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getEventDispatcher'])
            ->getMock();

        $eventDispatcher = $this->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getEventDispatcher')
            ->willReturn($eventDispatcher);

        $eventDispatcher->expects($this->once())
            ->method('dispatch');

        $handler->hasOpenActionsMessage();
    }

    public function test_find_action()
    {
        $handler = $this->getMockBuilder(ActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getbaseformhandler'])
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['findAction'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('findAction');

        $handler->findAction(1);
    }
}
