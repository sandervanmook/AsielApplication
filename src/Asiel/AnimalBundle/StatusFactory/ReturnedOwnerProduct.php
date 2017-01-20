<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;
use Asiel\AnimalBundle\Form\StatusType\ReturnedOwnerType;
use AsielBundle\StatusFactory\StatusType;

class ReturnedOwnerProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new ReturnedOwner(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = ReturnedOwnerType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('ReturnedOwner');
    }
}