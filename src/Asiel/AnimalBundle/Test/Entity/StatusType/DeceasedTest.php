<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Deceased;

class DeceasedTest extends \PHPUnit_Framework_TestCase
{
    private $deceased;

    public function setUp()
    {
        $this->deceased = new Deceased(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new Deceased(new AnimalStateMachine());
    }

    public function test_it_is_a_offsite_location()
    {
        $entity = new Deceased(new AnimalStateMachine());
        $this->assertTrue($entity->isOffsiteLocation());
    }

    public function test_it_is_not_an_onsite_location()
    {
        $entity = new Deceased(new AnimalStateMachine());
        $this->assertFalse($entity->isOnsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertFalse($this->deceased->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertFalse($this->deceased->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertFalse($this->deceased->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertFalse($this->deceased->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->deceased->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertFalse($this->deceased->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertFalse($this->deceased->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->deceased->getClassName(), 'Deceased');
    }
}
