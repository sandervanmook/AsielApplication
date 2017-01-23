<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\NoState;

class NoStateTest extends \PHPUnit_Framework_TestCase
{
    private $noState;

    public function setUp()
    {
        $this->noState = new NoState(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new NoState(new AnimalStateMachine());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertTrue($this->noState->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertFalse($this->noState->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertFalse($this->noState->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertTrue($this->noState->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->noState->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertFalse($this->noState->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertTrue($this->noState->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->noState->getClassName(), 'NoState');
    }


}
