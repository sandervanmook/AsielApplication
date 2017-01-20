<?php

namespace Asiel\AnimalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackendController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Animal/Backend/index.html.twig');
    }

    public function createAction()
    {
        return $this->render('@Animal/Backend/create.html.twig');
    }
}