<?php


namespace Asiel\AnimalBundle\Test\AnimalStateMachine;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\StatusType\Lost;

class AnimalStateMachineTest extends \PHPUnit_Framework_TestCase
{
    private $animalStateMachine;
    private $animal;

    public function setUp()
    {
        $this->animalStateMachine = new AnimalStateMachine();
        $this->animal = new Animal();
        $this->animal->addStatus(new Lost($this->animalStateMachine));
        $this->animalStateMachine->setAnimal($this->animal);
    }

    public function test_set_animal_with_no_active_state()
    {
        $animal = new Animal();
        $animalStateMachine = new AnimalStateMachine();
        $animalStateMachine->setAnimal($animal);
    }

    public function test_set_animal_with_active_state()
    {
        $animal = new Animal();
        $animal->addStatus(new Lost(new AnimalStateMachine()));
        $this->animalStateMachine->setAnimal($animal);
    }

    /**
     * Testing if the state change is allowed is done in the state entity itself.
     * These test are just for testing if the methods are still there.
     */

    public function test_change_to_abandoned()
    {
        $this->animalStateMachine->changeToAbandoned();
    }

    public function test_change_to_adopted()
    {
        $this->animalStateMachine->changeToAdopted();
    }

    public function test_change_to_deceased()
    {
        $this->animalStateMachine->changeToDeceased();
    }

    public function test_change_to_found()
    {
        $this->animalStateMachine->changeToFound();
    }

    public function test_change_to_lost()
    {
        $this->animalStateMachine->changeToLost();
    }

    public function test_change_to_returned_owner()
    {
        $this->animalStateMachine->changeToReturnedOwner();
    }

    public function test_change_to_seized()
    {
        $this->animalStateMachine->changeToSeized();
    }
}
