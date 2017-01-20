<?php

namespace Asiel\AnimalBundle\AnimalFactory;

class AnimalFactory extends Creator
{
    public function factoryMethod(AnimalType $animalType)
    {
        $animalProduct = 'Asiel\AnimalBundle\AnimalFactory\\'.$animalType.'Product';
        return new $animalProduct;
    }
}