<?php

namespace Asiel\StatisticsBundle\Controller;

use Asiel\CustomerBundle\Form\SearchCustomerType;
use Asiel\Shared\Filter\Customer\CustomerFilter;
use Asiel\StatisticsBundle\Form\FilterAnimalsKittenType;
use Asiel\StatisticsBundle\Form\FilterAnimalsLeavingType;
use Asiel\StatisticsBundle\Form\FilterAnimalsType;
use Asiel\StatisticsBundle\Stats\AnimalKittenStats;
use Asiel\StatisticsBundle\Stats\AnimalLeavingStats;
use Asiel\StatisticsBundle\Stats\AnimalStats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('StatisticsBundle:Backend:index.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function animalIncomingAction(Request $request)
    {
        $formHandler = $this->get('asiel.statisticsbundle.backendformhandler');

        $form = $this->createForm(FilterAnimalsType::class);
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

            return $this->render('StatisticsBundle:Backend:animalIncoming.html.twig', [
                'form' => $form->createView(),
                'result' => $result,
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'via' => $searchArray['via'],
                'municipalities' => implode(', ', $searchArray['municipality']),
            ]);

        }

        return $this->render('StatisticsBundle:Backend:animalIncoming.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function animalIncomingKittenAction(Request $request)
    {
        $formHandler = $this->get('asiel.statisticsbundle.backendformhandler');

        $form = $this->createForm(FilterAnimalsKittenType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();

            $allCats = $formHandler->getCatRepository()->findAll();

            $stats = new AnimalKittenStats($allCats, $searchArray);
            $stats->filter();
            $result = $stats->getFilterResult();

            return $this->render('@Statistics/Backend/animalIncomingKitten.html.twig', [
                'form' => $form->createView(),
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'result' => $result,
            ]);
        }

        return $this->render('@Statistics/Backend/animalIncomingKitten.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function animalLeavingAction(Request $request)
    {
        $formHandler = $this->get('asiel.statisticsbundle.backendformhandler');

        $form = $this->createForm(FilterAnimalsLeavingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();

            $allAnimals = $formHandler->getAnimalRepository()->findAll();

            $stats = new AnimalLeavingStats($allAnimals, $searchArray);
            $stats->filter();
            $result = $stats->getFilterResult();

            return $this->render('@Statistics/Backend/animalLeaving.html.twig', [
                'form' => $form->createView(),
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'result' => $result,
            ]);
        }

        return $this->render('@Statistics/Backend/animalLeaving.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return Response
     */
    public function customerActionsAction()
    {
        $form = $this->createForm(SearchCustomerType::class);

        return $this->render('@Statistics/Backend/customerActions.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function customerActionsShowAction(int $id)
    {
        $formHandler = $this->get('asiel.statisticsbundle.backendformhandler');

        $customer = $formHandler->getCustomerRepository()->find($id);
        $adoptedStatusRepository = $formHandler->getAdoptedStatusRepository();
        $abandonedStatusRepository = $formHandler->getAbandonedStatusRepository();
        $foundStatusRepository = $formHandler->getFoundStatusRepository();
        $returnedOwnerStatusRepository = $formHandler->getReturnedOwnerStatusRepository();

        $adopted = $adoptedStatusRepository->findBy(['customer' => $id]);
        $abandoned = $abandonedStatusRepository->findBy(['abandonedBy' => $id]);
        $found = $foundStatusRepository->findBy(['foundBy' => $id]);
        $returnedOwner = $returnedOwnerStatusRepository->findBy(['owner' => $id]);

        return $this->render('@Statistics/Backend/customerShow.html.twig', [
            'customer' => $customer,
            'adopted' => $adopted,
            'abandoned' => $abandoned,
            'found' => $found,
            'returnedowner' => $returnedOwner,
        ]);
    }

}
