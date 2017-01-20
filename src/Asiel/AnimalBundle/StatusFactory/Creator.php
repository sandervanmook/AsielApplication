<?php

namespace Asiel\AnimalBundle\StatusFactory;

abstract class Creator
{
    protected abstract function factoryMethod(StatusType $animalType);

    public function startFactory(StatusType $animalType)
    {
        return $this->factoryMethod($animalType);
    }
}