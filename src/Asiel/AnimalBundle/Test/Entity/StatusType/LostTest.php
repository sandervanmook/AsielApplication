<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Lost;

class LostTest extends \PHPUnit_Framework_TestCase
{
    private $lost;

    public function setUp()
    {
        $this->lost = new Lost(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new Lost(new AnimalStateMachine());
    }

    public function test_it_is_a_offsite_location()
    {
        $entity = new Lost(new AnimalStateMachine());
        $this->assertTrue($entity->isOffsiteLocation());
    }

    public function test_it_is_not_an_onsite_location()
    {
        $entity = new Lost(new AnimalStateMachine());
        $this->assertFalse($entity->isOnsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertFalse($this->lost->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertFalse($this->lost->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertFalse($this->lost->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertTrue($this->lost->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->lost->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertFalse($this->lost->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertTrue($this->lost->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->lost->getClassName(), 'Lost');
    }

}
