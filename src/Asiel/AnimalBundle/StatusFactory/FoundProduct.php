<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Form\StatusType\FoundType;
use AsielBundle\StatusFactory\StatusType;

class FoundProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Found(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = FoundType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Found');
    }
}