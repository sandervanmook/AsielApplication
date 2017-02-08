<?php

namespace Asiel\BookkeepingBundle\Controller;

use Asiel\AnimalBundle\Form\SearchAnimalType;
use Asiel\Shared\Filter\Animal\AnimalFilter;
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
        return $this->render('BookkeepingBundle:Backend:index.html.twig');
    }

    /**
     * @return Response
     */
    public function searchAnimalAction()
    {
        $form = $this->createForm(SearchAnimalType::class);

        return $this->render('BookkeepingBundle:Backend:searchAnimal.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function selectActionAction(int $id)
    {
        return $this->render('BookkeepingBundle:Backend:selectAction.html.twig');
    }




    /**
     * Ajax call
     * @param Request $request
     * @return Response
     */
    public function searchAnimalsDataAction(Request $request)
    {
        $animalRepository = $this->getDoctrine()->getRepository('AnimalBundle:Animal');
        $allAnimals = $animalRepository->findAll();

        $searchArray['type'] = $request->get('type');
        $searchArray['chipnumber'] = $request->get('chipnumber');

        $searchArray['gender'] = $request->get('gender');
        $searchArray['agestart'] = $request->get('agestart');
        $searchArray['ageend'] = $request->get('ageend');
        $searchArray['status']  = $request->get('status');
        $searchArray['sterilized']  = $request->get('sterilized');

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();

        $endResult = $filterAnimal->getFilterResult();

        return $this->render('@Bookkeeping/Backend/searchAnimalResult.html.twig', [
            'result' => $endResult,
        ]);
    }
}
