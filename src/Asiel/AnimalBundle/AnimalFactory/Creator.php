<?php

namespace Asiel\AnimalBundle\AnimalFactory;

abstract class Creator
{
    protected abstract function factoryMethod(AnimalType $animalType);

    public function startFactory(AnimalType $animalType)
    {
        return $this->factoryMethod($animalType);
    }
}