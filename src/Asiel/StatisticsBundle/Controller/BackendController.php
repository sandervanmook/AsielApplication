<?php

namespace Asiel\StatisticsBundle\Controller;

use Asiel\StatisticsBundle\Form\FilterAnimals;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackendController extends Controller
{
    public function indexAction()
    {
        return $this->render('StatisticsBundle:Backend:index.html.twig');
    }

    public function animalsAction(Request $request)
    {
        $formHandler = $this->get('asiel.statisticsbundle.backendformhandler');

        $form = $this->createForm(FilterAnimals::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


        }

        return $this->render('StatisticsBundle:Backend:animals.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
}
