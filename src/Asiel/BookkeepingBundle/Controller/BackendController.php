<?php

namespace Asiel\BookkeepingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('BookkeepingBundle:Backend:index.html.twig');
    }
}
