<?php

namespace Asiel\CalendarBundle\Event;

use Asiel\AnimalBundle\Entity\Animal;
use Symfony\Component\EventDispatcher\Event;

class TaskEvent extends Event
{
    private $dateDue;
    private $origin;
    private $animal;

    public function __construct(
        Animal $animalId,
        string $dateDue,
        array $origin
    )
    {
        $this->animal = $animalId;
        $this->dateDue = $dateDue;
        $this->origin  = $origin;
    }

    /**
     * @return mixed
     */
    public function getDateDue() : string
    {
        return $this->dateDue;
    }

    /**
     * @return mixed
     */
    public function getOrigin() : array
    {
        return $this->origin;
    }

    public function getAnimal() : Animal
    {
        return $this->animal;
    }

}