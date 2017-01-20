<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Form\StatusType\AdoptedType;
use AsielBundle\StatusFactory\StatusType;

class AdoptedProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Adopted(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = AdoptedType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Adopted');
    }
}