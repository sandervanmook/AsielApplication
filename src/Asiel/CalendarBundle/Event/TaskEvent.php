<?php

namespace Asiel\CalendarBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class TaskEvent extends Event
{
    private $dateDue;
    private $origin;

    public function __construct(
        string $dateDue,
        array $origin
    )
    {
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

}