<?php

namespace Asiel\AnimalBundle\AnimalFactory;

abstract class Animal
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

    public function getEntity() : \Asiel\AnimalBundle\Entity\Animal
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
}