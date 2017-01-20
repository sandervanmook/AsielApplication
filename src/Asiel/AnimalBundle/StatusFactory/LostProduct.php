<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Lost;
use Asiel\AnimalBundle\Form\StatusType\LostType;
use AsielBundle\StatusFactory\StatusType;

class LostProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Lost(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = LostType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Lost');
    }
}