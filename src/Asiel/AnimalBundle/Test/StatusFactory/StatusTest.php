<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\StatusFactory\StatusFactory;
use Asiel\AnimalBundle\StatusFactory\StatusType;

class StatusTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_full_class_name()
    {
        $statusType = new StatusType('Found');
        $statusFactory = new StatusFactory();
        $foundProduct = $statusFactory->startFactory($statusType);

        $this->assertEquals($foundProduct->getFullClassName(), 'Asiel\AnimalBundle:StatusType\Found');
    }
}
