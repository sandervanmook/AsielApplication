<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\AnimalFactory\AnimalFactory;
use Asiel\AnimalBundle\AnimalFactory\AnimalType;
use Asiel\AnimalBundle\Form\SearchAnimalType;
use Asiel\Shared\Filter\Animal\AnimalFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $form = $this->createForm(SearchAnimalType::class);

        return $this->render('@Animal/Backend/Animal/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');

        $form = $this->createFormBuilder()
            ->add('chipnumber', TextType::class, [
                'label' => 'Chipnummer',
                'attr' => [
                    'placeholder' => '15 cijferige chipnummer',
                    'maxlength' => 15,
                    'class' => 'inline field',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zoeken',
                'attr' => [
                    'class' => 'ui button positive',
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $chipnumber = $form->get('chipnumber')->getData();

            // If it's not a valid chipnummer show error and let user try again.
            if (!$formHandler->validChipnumber($chipnumber)) {
                return $this->render('@Animal/Backend/Animal/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            // If we found it internally, show result. User can't create new animal.
            if ($formHandler->searchChipnumberInternal($chipnumber)) {
                $internalResult = $formHandler->searchChipnumberInternal($chipnumber);

                return $this->render('@Animal/Backend/Animal/create.html.twig', [
                    'form' => $form->createView(),
                    'internalresult' => $internalResult,
                ]);
            } else {
                $internalResult = null;
            }

            // We didn't found the animal internally, search externally and give the option to create new animal
            if ($formHandler->ndgResult($chipnumber)) {
                $ndgResult = $formHandler->ndgResult($chipnumber);
            } else {
                $ndgResult = null;
            }

            if ($formHandler->bhcResult($chipnumber)) {
                $bhcResult = $formHandler->bhcResult($chipnumber);
            } else {
                $bhcResult = null;
            }

            if ($formHandler->idchipsResult($chipnumber)) {
                $idchipsResult = $formHandler->idchipsResult($chipnumber);
            } else {
                $idchipsResult = null;
            }

            return $this->render('@Animal/Backend/Animal/create.html.twig', [
                'form' => $form->createView(),
                'internalresult' => $internalResult,
                'ndgresult' => $ndgResult,
                'bhcresult' => $bhcResult,
                'idchipsresult' => $idchipsResult,
            ]);
        }

        return $this->render('@Animal/Backend/Animal/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param string $type
     * @return RedirectResponse|Response
     */
    public function registerAction(Request $request, string $type)
    {
        $animalType = new AnimalType($type);
        $animalFactory = new AnimalFactory();
        $animalProduct = $animalFactory->startFactory($animalType);
        $animal = $animalProduct->getEntity();

        $form = $this->createForm($animalProduct->getFormType(), $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.animalbundle.animalformhandler');
            $formHandler->create($animal);

            return new RedirectResponse($this->generateUrl('backend_animal_show', ['id' => $animal->getId()]));
        }

        return $this->render('@Animal/Backend/Animal/' . $animalProduct . '/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function showAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');
        return $this->render('@Animal/Backend/Animal/show.html.twig', [
            'animal' => $formHandler->find($id),
            'activestate' => $formHandler->getActiveState($id),
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAction(int $id, Request $request)
    {
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');
        $animal = $formHandler->find($id);
        $animalFactory = new AnimalFactory();
        $animalProduct = $animalFactory->startFactory(new AnimalType($animal->getClassName()));

        $form = $this->createForm($animalProduct->getFormType(), $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit($animal);

            return new RedirectResponse($this->generateUrl('backend_animal_show', ['id' => $animal->getId()]));
        }
        return $this->render('@Animal/Backend/Animal/' . $animalProduct . '/edit.html.twig', [
            'form' => $form->createView(),
            'animaltype' => $animalProduct,
        ]);
    }

    /**
     * Ajax call
     * @param Request $request
     * @param string $requestby
     * @return Response
     */
    public function searchAnimalsDataAction(Request $request, string $requestby)
    {
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');

        $allAnimals = $formHandler->getRepository()->findAll();

        $searchArray['type'] = $request->get('type');
        $searchArray['chipnumber'] = $request->get('chipnumber');

        $searchArray['gender'] = $request->get('gender');
        $searchArray['agestart'] = $request->get('agestart');
        $searchArray['ageend'] = $request->get('ageend');
        $searchArray['status'] = $request->get('status');
        $searchArray['sterilized'] = $request->get('sterilized');

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();

        $endResult = $filterAnimal->getFilterResult();

        switch ($requestby) {
            case 'bookkeepingbundle' :
                return $this->render('@Bookkeeping/Backend/Action/searchAnimalResult.html.twig', [
                    'result' => $endResult,
                ]);
            case 'animalbundle' :
                return $this->render('@Animal/Backend/Animal/searchResult.html.twig', [
                    'result' => $endResult,
                ]);
            default:
                return $this->render('@Animal/Backend/Animal/searchResult.html.twig', [
                    'result' => $endResult,
                ]);
        }
    }

    /**
     * Ajax Call
     * @param int $chipnumber
     * @return JsonResponse
     */
    public function findOnChipnumberAction(int $chipnumber)
    {
        $result = $this->getDoctrine()->getRepository('AnimalBundle:Animal')->findOnChipnumber($chipnumber);

        return new JsonResponse($result);
    }

    /**
     * Embedded as controller in template when editing an animal.
     * @param $id
     * @return Response
     */
    public function animalInfoAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');
        $openTasks = $formHandler->getRepository()->findIncompleteTasks($id);

        return $this->render('@Animal/Backend/Animal/animalInfo.html.twig', [
            'info' => $formHandler->getRepository()->find($id),
            'opentasks' => $openTasks,
        ]);
    }

}