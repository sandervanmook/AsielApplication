<?php

namespace Asiel\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $browser = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;

        if (!strpos($browser,'Chrome')) {
            $warning = 'We zien dat u geen Chrome als browser gebruikt. Om optimaal gebruik van deze applicatie te maken adviseren wij u Chrome te gebruiken.';
        } else {
            $warning = null;
        }

        return $this->render('BackendBundle:Default:index.html.twig', [
            'browser' => $warning,
        ]);
    }
}
