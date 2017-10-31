<?php

namespace Asiel\AnimalBundle\AnimalFactory;

class AnimalFactory extends Creator
{
    public function factoryMethod(AnimalType $animalType) : Animal
    {
        $animalProduct = 'Asiel\AnimalBundle\AnimalFactory\\'.$animalType.'Product';
        return new $animalProduct;
    }
}