<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Form\MedicalType;
use Asiel\AnimalBundle\Service\MedicalFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BackendMedicalController extends Controller
{
    private $medicalFormHandler;

    public function __construct(MedicalFormHandler $medicalFormHandler)
    {
        $this->medicalFormHandler = $medicalFormHandler;
    }

    public function indexAction(int $id)
    {
        return $this->render('@Animal/Backend/Medical/index.html.twig', [
            'result' => $this->medicalFormHandler->getRepository()->findBy(['animal' => $this->medicalFormHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    public function createAction(Request $request, int $id)
    {
        $medical = new Medical();

        $form = $this->createForm(MedicalType::class, $medical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->medicalFormHandler->create($medical, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_medical_index', ['id' => $id]));
        }
        return $this->render(('@Animal/Backend/Medical/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }

    public function showAction($medicalid)
    {
        return $this->render('@Animal/Backend/Medical/show.html.twig', [
            'medical' => $this->medicalFormHandler->find($medicalid),
        ]);
    }

    public function deleteAction($id)
    {
        $this->medicalFormHandler->delete($this->medicalFormHandler->find($id));

        return new Response('Command received.');
    }

}