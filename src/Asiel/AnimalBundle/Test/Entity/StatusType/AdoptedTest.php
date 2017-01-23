<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;

class AdoptedTest extends \PHPUnit_Framework_TestCase
{
    private $adopted;

    public function setUp()
    {
        $this->adopted = new Adopted(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new Adopted(new AnimalStateMachine());
    }

    public function test_it_is_a_offsite_location()
    {
        $entity = new Adopted(new AnimalStateMachine());
        $this->assertTrue($entity->isOffsiteLocation());
    }

    public function test_it_is_not_an_onsite_location()
    {
        $entity = new Adopted(new AnimalStateMachine());
        $this->assertFalse($entity->isOnsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertTrue($this->adopted->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertFalse($this->adopted->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertFalse($this->adopted->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertTrue($this->adopted->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->adopted->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertFalse($this->adopted->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertTrue($this->adopted->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->adopted->getClassName(), 'Adopted');
    }

}
