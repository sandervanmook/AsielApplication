<?php

namespace Asiel\BookkeepingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackendController extends Controller
{
    public function indexAction()
    {
        return $this->render('BookkeepingBundle:Default:index.html.twig');
    }
}
