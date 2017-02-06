<?php

namespace Asiel\StatisticsBundle\Controller;

use Asiel\StatisticsBundle\Form\FilterAnimals;
use Asiel\StatisticsBundle\Stats\AnimalStats;
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
            $searchArray['via'] = $form->get('via')->getData();
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();
            $searchArray['municipality'] = $form->get('municipality')->getData();

            $allAnimals = $formHandler->getAnimalRepository()->findAll();

            $stats = new AnimalStats($allAnimals, $searchArray);
            $stats->filter();
            $result = $stats->getFilterResult();

            return $this->render('StatisticsBundle:Backend:animals.html.twig', [
                'form' => $form->createView(),
                'result' => $result,
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'via' => $searchArray['via'],
                'municipalities' => implode(', ', $searchArray['municipality']),
            ]);

        }

        return $this->render('StatisticsBundle:Backend:animals.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
