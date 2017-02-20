<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;

class FoundTest extends \PHPUnit_Framework_TestCase
{
    private $found;

    public function setUp()
    {
        $this->found = new Found(new AnimalStateMachine());
    }

    public function test_it_instantiates()
    {
        $entity = new Found(new AnimalStateMachine());
    }

    public function test_it_is_a_onsite_location()
    {
        $entity = new Found(new AnimalStateMachine());
        $this->assertTrue($entity->isOnsiteLocation());
    }

    public function test_it_is_not_an_offsite_location()
    {
        $entity = new Found(new AnimalStateMachine());
        $this->assertFalse($entity->isOffsiteLocation());
    }

    // Check constants

    public function test_constant_found_chipped_title()
    {
        $this->assertArrayHasKey('title', Found::FOUND_CHIPPED);
    }

    public function test_constant_found_chipped_description()
    {
        $this->assertArrayHasKey('description', Found::FOUND_CHIPPED);
    }

    public function test_constant_found_checkup_title()
    {
        $this->assertArrayHasKey('title', Found::FOUND_CHECKUP);
    }

    public function test_constant_found_checkup_description()
    {
        $this->assertArrayHasKey('description', Found::FOUND_CHECKUP);
    }

    public function test_constant_found_available_title()
    {
        $this->assertArrayHasKey('title', Found::FOUND_AVAILABLE);
    }

    public function test_constant_found_available_description()
    {
        $this->assertArrayHasKey('description', Found::FOUND_AVAILABLE);
    }


    // State Machine

    public function test_to_abandoned()
    {
        $this->assertTrue($this->found->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertTrue($this->found->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertTrue($this->found->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertFalse($this->found->toFound());
    }

    public function test_to_lost()
    {
        $this->assertTrue($this->found->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertTrue($this->found->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertTrue($this->found->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->found->getClassName(), 'Found');
    }

}
