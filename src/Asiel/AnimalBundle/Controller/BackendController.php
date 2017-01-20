<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\AnimalFactory\AnimalFactory;
use Asiel\AnimalBundle\AnimalFactory\AnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackendController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Animal/Backend/index.html.twig');
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
            $this->animalManager->create($animal);

            // Force the user to create a status as this is mandatory.
            return new RedirectResponse($this->baseController->getRouter()->generate('asiel_animal_edit_status_create', [ 'id' => $animal->getId()]));
        }

        return $this->baseController->getTwigEngine()->renderResponse('@Asiel/Animal/'.$animalProduct.'/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}