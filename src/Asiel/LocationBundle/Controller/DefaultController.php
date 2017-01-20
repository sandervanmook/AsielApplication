<?php

namespace Asiel\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Location/Default/create.html.twig', [
            'alllocations' => $this->getDoctrine()->getRepository('LocationBundle:Location')->findAll(),
        ]);
    }

    public function createAction()
    {
        return $this->render('LocationBundle:Default:create.html.twig');
    }
}
