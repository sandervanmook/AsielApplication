<?php

namespace Asiel\StatisticsBundle\Controller;

use Asiel\CustomerBundle\Form\SearchCustomerType;
use Asiel\Shared\Filter\Customer\CustomerFilter;
use Asiel\StatisticsBundle\Form\FilterAnimals;
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
     * @return Response
     */
    public function customerActionsAction()
    {
        $form = $this->createForm(SearchCustomerType::class);

        return $this->render('@Statistics/Backend/customerActions.html.twig', [
            'form' => $form->createView(),
        ]);
    }

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

    /**
     * Ajax call
     * @param Request $request
     * @return Response
     */
    public function searchCustomersDataAction(Request $request)
    {
        $formHandler = $this->get('asiel.customerbundle.customerformhandler');

        $allCustomers = $formHandler->getRepository()->findAll();

        $searchArray['lastname'] = $request->get('lastname');
        $searchArray['city'] = $request->get('city');
        $searchArray['citizenservicenumber'] = $request->get('citizenservicenumber');

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $endResult = $filterCustomer->getFilterResult();

        return $this->render('@Statistics/Backend/customerSearchResult.html.twig', [
            'result' => $endResult,
        ]);
    }
}
