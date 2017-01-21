<?php

namespace Asiel\AnimalBundle\StatusFactory;

class StatusFactory extends Creator
{
    public function factoryMethod(StatusType $statusType)
    {
        $statusProduct = 'Asiel\AnimalBundle\StatusFactory\\' . $statusType . 'Product';
        return new $statusProduct;
    }
}