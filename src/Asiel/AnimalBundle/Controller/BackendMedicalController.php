<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Form\MedicalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BackendMedicalController extends Controller
{
    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.medicalformhandler');

        return $this->render('@Animal/Backend/Medical/index.html.twig', [
            'result' => $formHandler->getRepository()->findBy(['animal' => $formHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    public function createAction(Request $request, int $id)
    {
        $medical = new Medical();

        $form = $this->createForm(MedicalType::class, $medical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.animalbundle.medicalformhandler');
            $formHandler->create($medical, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_medical_index', ['id' => $id]));
        }
        return $this->render(('@Animal/Backend/Medical/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }

    public function showAction($medicalid)
    {
        $formHandler = $this->get('asiel.animalbundle.medicalformhandler');
        return $this->render('@Animal/Backend/Medical/show.html.twig', [
            'medical' => $formHandler->find($medicalid),
        ]);
    }

    public function deleteAction($id)
    {
        $formHandler = $this->get('asiel.animalbundle.medicalformhandler');
        $formHandler->delete($formHandler->find($id));

        return new Response('Command received.');
    }

}