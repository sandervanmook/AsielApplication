<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\AnimalFactory\AnimalFactory;
use Asiel\AnimalBundle\AnimalFactory\AnimalType;
use Asiel\AnimalBundle\Form\Search\SearchAnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class BackendController extends Controller
{
    public function indexAction(Request $request)
    {
        $formHandler = $this->get('asiel.animalbundle.formhandler');
        $result = $this->getDoctrine()->getRepository('AnimalBundle:Animal')->findAll();
        $formHandler->checkNoStatus($result);

        return $this->render('@Animal/Backend/index.html.twig', [
            'result'     => $result,
        ]);
    }

    public function createAction()
    {
        return $this->render('@Animal/Backend/create.html.twig');
    }

    public function registerAction(Request $request, $type)
    {
        $animalType = new AnimalType($type);
        $animalFactory = new AnimalFactory();
        $animalProduct = $animalFactory->startFactory($animalType);
        $animal = $animalProduct->getEntity();

        $form = $this->createForm($animalProduct->getFormType(), $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.animalbundle.formhandler');
            $formHandler->create($animal);

            // TODO
            // Force the user to create a status as this is mandatory.
            return new RedirectResponse($this->generateUrl('backend_animal_index'));
        }

        return $this->render('@Animal/Backend/'.$animalProduct.'/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}