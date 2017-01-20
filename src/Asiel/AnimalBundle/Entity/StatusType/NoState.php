<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;

class NoState implements AnimalState
{
    private $stateMachine;

    /**
     * @return null
     */
    public function getId()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return 'NoState';
    }

    public function __construct(AnimalStateMachine $animalStateMachine)
    {
        $this->stateMachine = $animalStateMachine;
    }

    /**
     * Statemachine methods
     */
    public function toAbandoned() : bool
    {
        return true;
    }
    public function toAdopted() : bool
    {
        return false;
    }
    public function toDeceased() : bool
    {
        return false;
    }
    public function toFound() : bool
    {
        return true;
    }
    public function toLost() : bool
    {
        return false;
    }
    public function toReturnedOwner() : bool
    {
        return false;
    }
    public function toSeized() : bool
    {
        return true;
    }
}