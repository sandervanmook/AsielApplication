<?php

namespace Asiel\AnimalBundle\AnimalFactory;

use Exception;

class AnimalType
{
    private $value;
    private $animalTypes= [
        'Dog',
        'Cat'
    ];

    public function __construct(string $animalType)
    {
        if (!in_array($animalType, $this->animalTypes)) {
            throw new Exception('Animal type '.$animalType.' not found.');
        }
        $this->value = $animalType;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }
}