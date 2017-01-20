<?php

namespace Asiel\AnimalBundle\StatusFactory;

use Exception;

class StatusType
{
    private $value;
    private $statusTypes= [
        'Abandoned',
        'Adopted',
        'Deceased',
        'Found',
        'Lost',
        'NoState',
        'ReturnedOwner',
        'Seized',
    ];

    public function __construct(string $statusType)
    {
        if (!in_array($statusType, $this->statusTypes)) {
            throw new Exception('Status type '.$statusType.' not found.');
        }
        $this->value = $statusType;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function getValue() : string
    {
        return $this->value;
    }
}