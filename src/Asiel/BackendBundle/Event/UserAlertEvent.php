<?php

namespace Asiel\BackendBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class UserAlertEvent extends Event
{
    private $type;
    private $message;
    private $data;

    const SUCCESS   = 'success';
    const INFO      = 'info';
    const WARNING   = 'warning';
    const DANGER    = 'danger';

    public function __construct(
        string $type,
        string $message = null,
        $data = null
    )
    {
        $this->checkType($type);
        $this->message  = $message;
        $this->data     = $data;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $type
     * @throws \Exception
     */
    private function checkType($type)
    {
        if (!in_array($type, [
            self::SUCCESS,
            self::INFO,
            self::WARNING,
            self::DANGER,
        ])
        )
        {
            throw new \Exception('Unknown Alert type.');
        }

        $this->type = $type;
    }

}