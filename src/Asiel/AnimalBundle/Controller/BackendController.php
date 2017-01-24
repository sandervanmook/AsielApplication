<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\AnimalFactory\AnimalFactory;
use Asiel\AnimalBundle\AnimalFactory\AnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $formHandler = $this->get('asiel.animalbundle.animalformhandler');
        $result = $this->getDoctrine()->getRepository('AnimalBundle:Animal')->findAll();
        $formHandler->checkNoStatus($result);

        return $this->render('@Animal/Backend/Animal/index.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @return Response
     */
    public function createAction()
    {
        return $this->render('@Animal/Backend/Animal/create.html.twig');
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

            // Force the user to create a status as this is mandatory.
            return new RedirectResponse($this->generateUrl('backend_animal_status_create', ['id' => $animal->getId()]));
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
            'info'  => $formHandler->getRepository()->find($id),
            'opentasks' => $openTasks,
        ]);
    }

}