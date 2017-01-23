<?php


namespace AsielBundle\Test\StatusFactory;


use Asiel\AnimalBundle\StatusFactory\StatusType;

class StatusTypeTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $statusType = new StatusType('Lost');
        $value = $statusType->getValue();

        $this->assertEquals($statusType, $value);
    }

    /**
     * @expectedException \Exception
     */
    public function test_it_throws_when_unknown_type()
    {
        $statusType = new StatusType('Yolo');
    }

}
