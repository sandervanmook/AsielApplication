<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Form\IncidentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BackendIncidentController extends Controller
{
    public function indexAction(int $id)
    {
        $formHandler = $this->get('asiel.animalbundle.incidentformhandler');

        return $this->render('@Animal/Backend/Incident/index.html.twig', [
            'incidents' => $formHandler->getRepository()->findBy(['animal' => $formHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    public function createAction(Request $request, int $id)
    {
        $incident = new Incident();

        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.animalbundle.incidentformhandler');
            $formHandler->create($incident, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_incident_index', ['id' => $id]));
        }
        return $this->render(('@Animal/Backend/Incident/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }

    public function showAction($incidentid)
    {
        $formHandler = $this->get('asiel.animalbundle.incidentformhandler');
        return $this->render('@Animal/Backend/Incident/show.html.twig', [
            'incident' => $formHandler->find($incidentid),
        ]);
    }

    public function deleteAction($id)
    {
        $formHandler = $this->get('asiel.animalbundle.incidentformhandler');
        $formHandler->delete($formHandler->find($id));

        return new Response('Command received.');
    }

}