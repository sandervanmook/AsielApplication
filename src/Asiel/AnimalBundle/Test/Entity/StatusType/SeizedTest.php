<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Seized;

class SeizedTest extends \PHPUnit_Framework_TestCase
{
    private $seized;

    public function setUp()
    {
        $this->seized = new Seized(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new Seized(new AnimalStateMachine());
    }

    public function test_it_is_a_onsite_location()
    {
        $entity = new Seized(new AnimalStateMachine());
        $this->assertTrue($entity->isOnsiteLocation());
    }

    public function test_it_is_not_an_offsite_location()
    {
        $entity = new Seized(new AnimalStateMachine());
        $this->assertFalse($entity->isOffsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertFalse($this->seized->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertTrue($this->seized->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertTrue($this->seized->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertFalse($this->seized->toFound());
    }

    public function test_to_lost()
    {
        $this->assertTrue($this->seized->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertTrue($this->seized->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertFalse($this->seized->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->seized->getClassName(), 'Seized');
    }

}
