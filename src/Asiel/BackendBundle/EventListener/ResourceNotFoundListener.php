<?php

namespace Asiel\BackendBundle\EventListener;

use Asiel\BackendBundle\Event\ResourceNotFoundEvent;
use Symfony\Bridge\Twig\TwigEngine;

class ResourceNotFoundListener
{
    private $twig;

    public function __construct(TwigEngine $twigEngine)
    {
        $this->twig = $twigEngine;
    }

    public function onResourceNotFoundEvent(ResourceNotFoundEvent $event)
    {
        $type       = $event->getType();
        $id         = $event->getId();

        if (!is_null($id)) {
            $message = sprintf('%s met id %s is niet gevonden.', ucfirst($type), $id);
        }
        else {
            $message = sprintf('%s type is niet gevonden.', ucfirst($type));
        }

        echo $this->twig->render('BackendBundle:Errors:404.html.twig', ['message' => $message]);
    }
}