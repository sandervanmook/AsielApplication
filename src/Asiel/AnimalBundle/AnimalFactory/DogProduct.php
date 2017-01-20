<?php

namespace Asiel\AnimalBundle\AnimalFactory;

use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Form\AnimalType\DogType;

class DogProduct extends Animal
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Dog();
    }

    protected function setFormType()
    {
        $this->formType = DogType::class;
    }

    protected function setType()
    {
        $this->type = new AnimalType('Dog');
    }
}