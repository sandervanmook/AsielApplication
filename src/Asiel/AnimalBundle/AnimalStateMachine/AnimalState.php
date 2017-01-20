<?php

namespace Asiel\AnimalBundle\AnimalStateMachine;

interface AnimalState
{
    /**
     * Be sure to return parent::getId() otherwise it will return null
     * @return integer
     */
    public function getId();

    /**
     * Used in the controllers, for \Model\ValueType\Type.php, and to get the Discriminator Column value.
     * Just return the class name not the fully qualified name.
     * @return string
     */
    public function getClassName();

    // Statemachine state change methods
    public function toAbandoned() : bool;
    public function toAdopted() : bool;
    public function toDeceased() : bool;
    public function toFound() : bool;
    public function toLost() : bool;
    public function toReturnedOwner() : bool;
    public function toSeized() : bool;
}