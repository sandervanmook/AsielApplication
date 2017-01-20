<?php

namespace Asiel\AnimalBundle\StatusFactory;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Form\StatusType\AbandonedType;
use AsielBundle\StatusFactory\StatusType;

class AbandonedProduct extends Status
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function setEntity()
    {
        $this->entity = new Abandoned(new AnimalStateMachine());
    }

    protected function setFormType()
    {
        $this->formType = AbandonedType::class;
    }

    protected function setType()
    {
        $this->type = new StatusType('Abandoned');
    }
}