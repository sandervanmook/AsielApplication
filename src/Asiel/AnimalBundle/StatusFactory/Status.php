<?php

namespace Asiel\AnimalBundle\StatusFactory;

abstract class Status
{
    protected $entity;
    protected $formType;
    protected $type;

    protected abstract function setEntity();
    protected abstract function setFormType();
    protected abstract function setType();

    public function __construct()
    {
        $this->setEntity();
        $this->setFormType();
        $this->setType();
    }

    public function __toString()
    {
        return $this->getType();
    }

    public function getEntity() : \Asiel\AnimalBundle\Entity\Status
    {
        return $this->entity;
    }

    public function getFormType() : string
    {
        return $this->formType;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getFullClassName()
    {
        return 'Asiel\AnimalBundle:StatusType\\'.$this->getType();
    }
}