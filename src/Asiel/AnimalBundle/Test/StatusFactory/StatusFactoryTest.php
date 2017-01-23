<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\StatusFactory\StatusFactory;
use Asiel\AnimalBundle\StatusFactory\StatusType;

class StatusFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_start_factory()
    {
        $statusFactory = new StatusFactory();
        $statusFactory->startFactory(new StatusType('Lost'));
    }
}
