<?php

namespace Asiel\AnimalBundle\AnimalStateMachine;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\StatusType\NoState;


class AnimalStateMachine
{
    /**
     * In a normal statemachine implementation the statemachine should keep track of the active state.
     * As we are dealing with active and archived states and we only want to know if the new state is allowed, I changed the implementation a bit.
     */

    private $currentState;

    private $animal;

    /**
     * Set the current state
     * Not used as we do not set the state from this class
     * @param AnimalState $state
     */
//    public function setState(AnimalState $state)
//    {
//        $this->currentState = $state;
//    }

    /**
     * Sets the animal we're currently working with
     * @param Animal $animal
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        // Set current state
        $this->currentState = $animal->getActiveState();
    }

    /**
     * Triggers
     * The result of all methods of the state classes is true / false
     * If it's true the state change is allowed
     */

    public function changeToAbandoned()
    {
        return $this->currentState->toAbandoned();
    }

    public function changeToAdopted()
    {
        return $this->currentState->toAdopted();
    }

    public function changeToDeceased()
    {
        return $this->currentState->toDeceased();
    }

    public function changeToFound()
    {
        return $this->currentState->toFound();
    }

    public function changeToLost()
    {
        return $this->currentState->toLost();
    }

    public function changeToReturnedOwner()
    {
        return $this->currentState->toReturnedOwner();
    }

    public function changeToSeized()
    {
        return $this->currentState->toSeized();
    }

    /**
     * No need for state getters as we are not using setState()
     */
}