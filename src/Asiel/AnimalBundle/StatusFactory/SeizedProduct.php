<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Seized;
use Asiel\AnimalBundle\Form\StatusType\SeizedType;

class SeizedProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Seized(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = SeizedType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Seized');
    }
}