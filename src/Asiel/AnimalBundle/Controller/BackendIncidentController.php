<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Form\IncidentType;
use Asiel\AnimalBundle\Service\IncidentFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BackendIncidentController extends Controller
{
    private $incidentFormHandler;

    public function __construct(IncidentFormHandler $incidentFormHandler)
    {
        $this->incidentFormHandler = $incidentFormHandler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        return $this->render('@Animal/Backend/Incident/index.html.twig', [
            'incidents' => $this->incidentFormHandler->getRepository()->findBy(['animal' => $this->incidentFormHandler->getAnimalRepository()->find($id)]),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $incident = new Incident();

        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->incidentFormHandler->create($incident, $id);

            return new RedirectResponse($this->generateUrl('backend_animal_incident_index', ['id' => $id]));
        }
        return $this->render(('@Animal/Backend/Incident/create.html.twig'), [
            'form'      => $form->createView(),
        ]);
    }

    public function showAction($incidentid)
    {
        return $this->render('@Animal/Backend/Incident/show.html.twig', [
            'incident' => $this->incidentFormHandler->find($incidentid),
        ]);
    }

    public function deleteAction($id)
    {
        $this->incidentFormHandler->delete($this->incidentFormHandler->find($id));

        return new Response('Command received.');
    }

}