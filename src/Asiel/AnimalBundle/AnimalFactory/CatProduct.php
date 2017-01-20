<?php

namespace Asiel\AnimalBundle\AnimalFactory;

use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Form\AnimalType\CatType;

class CatProduct extends Animal
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Cat();
    }

    protected function setFormType()
    {
        $this->formType = CatType::class;
    }

    protected function setType()
    {
        $this->type = new AnimalType('Cat');
    }
}