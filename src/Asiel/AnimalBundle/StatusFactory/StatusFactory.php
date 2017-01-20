<?php

namespace Asiel\AnimalBundle\StatusFactory;

class StatusFactory extends Creator
{
    public function factoryMethod(StatusType $statusType)
    {
        $statusProduct = 'AsielBundle\StatusFactory\\' . $statusType . 'Product';
        return new $statusProduct;
    }
}