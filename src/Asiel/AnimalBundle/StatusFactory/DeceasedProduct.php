<?php

namespace Asiel\AnimalBundle\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Deceased;
use Asiel\AnimalBundle\Form\StatusType\DeceasedType;
use AsielBundle\StatusFactory\StatusType;

class DeceasedProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Deceased(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = DeceasedType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Deceased');
    }
}