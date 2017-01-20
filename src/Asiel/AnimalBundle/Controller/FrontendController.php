<?php

namespace Asiel\AnimalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Backend/AnimalBundle/index.html.twig');
    }
}