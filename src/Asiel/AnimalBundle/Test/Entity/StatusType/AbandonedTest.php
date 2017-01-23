<?php


namespace Asiel\AnimalBundle\Test\Entity\StatusType;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;

class AbandonedTest extends \PHPUnit_Framework_TestCase
{
    private $abandoned;

    public function setUp()
    {
        $this->abandoned = new Abandoned(new AnimalStateMachine());
    }

    // Check constants

    public function test_constant_abandon_chipped_title()
    {
        $this->assertArrayHasKey('title', Abandoned::ABANDON_CHIPPED);
    }

    public function test_constant_abandon_chipped_description()
    {
        $this->assertArrayHasKey('description', Abandoned::ABANDON_CHIPPED);
    }

    public function test_constant_abandon_vaccine_title()
    {
        $this->assertArrayHasKey('title', Abandoned::ABANDON_VACCINE);
    }

    public function test_constant_abandon_vaccine_description()
    {
        $this->assertArrayHasKey('description', Abandoned::ABANDON_VACCINE);
    }

    public function test_constant_abandon_sterilize_title()
    {
        $this->assertArrayHasKey('title', Abandoned::ABANDON_STERILIZE);
    }

    public function test_constant_abandon_sterilize_description()
    {
        $this->assertArrayHasKey('description', Abandoned::ABANDON_STERILIZE);
    }

    public function test_constant_abandon_passport_title()
    {
        $this->assertArrayHasKey('title', Abandoned::ABANDON_PASSPORT);
    }

    public function test_constant_abandon_passport_description()
    {
        $this->assertArrayHasKey('description', Abandoned::ABANDON_PASSPORT);
    }


    public function test_it_instantiates()
    {
        $entity = new Abandoned(new AnimalStateMachine());
    }

    public function test_it_is_a_onsite_location()
    {
        $entity = new Abandoned(new AnimalStateMachine());
        $this->assertTrue($entity->isOnsiteLocation());
    }

    public function test_it_is_not_an_offsite_location()
    {
        $entity = new Abandoned(new AnimalStateMachine());
        $this->assertFalse($entity->isOffsiteLocation());
    }

    // State Machine

    public function test_to_abandoned()
    {
        $this->assertFalse($this->abandoned->toAbandoned());
    }

    public function test_to_adopted()
    {
        $this->assertTrue($this->abandoned->toAdopted());
    }

    public function test_to_deceased()
    {
        $this->assertTrue($this->abandoned->toDeceased());
    }

    public function test_to_found()
    {
        $this->assertFalse($this->abandoned->toFound());
    }

    public function test_to_lost()
    {
        $this->assertFalse($this->abandoned->toLost());
    }

    public function test_to_returned_owner()
    {
        $this->assertTrue($this->abandoned->toReturnedOwner());
    }

    public function test_to_seized()
    {
        $this->assertFalse($this->abandoned->toSeized());
    }


    public function test_get_classname()
    {
        $this->assertEquals($this->abandoned->getClassName(), 'Abandoned');
    }
}
