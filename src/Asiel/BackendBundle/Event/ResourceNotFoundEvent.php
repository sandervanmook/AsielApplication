<?php

namespace Asiel\BackendBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ResourceNotFoundEvent extends Event
{
    private $type;
    private $id;

    public function __construct(string $type, $id)
    {
        $this->type = $type;
        $this->id   = $id;
    }

    /**
     * @return mixed
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}