<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;

class ReturnedOwnerTest extends \PHPUnit_Framework_TestCase
{
    private $returnedOwner;

    public function setUp()
    {
        $this->returnedOwner = new ReturnedOwner(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new ReturnedOwner(new AnimalStateMachine());
    }

    public function test_it_is_a_offsite_location()
    {
        $entity = new ReturnedOwner(new AnimalStateMachine());
        $this->assertTrue($entity->isOffsiteLocation());
    }

    public function test_it_is_not_an_onsite_location()
    {
        $entity = new ReturnedOwner(new AnimalStateMachine());
        $this->assertFalse($entity->isOnsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertTrue($this->returnedOwner->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertFalse($this->returnedOwner->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertFalse($this->returnedOwner->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertTrue($this->returnedOwner->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->returnedOwner->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertFalse($this->returnedOwner->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertTrue($this->returnedOwner->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->returnedOwner->getClassName(), 'ReturnedOwner');
    }


}
