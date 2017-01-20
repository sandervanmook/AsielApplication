<?php

namespace Asiel\LocationBundle\Controller;

use Asiel\LocationBundle\Entity\Location;
use Asiel\LocationBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Location/Default/index.html.twig', [
            'alllocations' => $this->getDoctrine()->getRepository('LocationBundle:Location')->findAll(),
        ]);
    }

    public function createAction(Request $request)
    {
        $location = new Location();

        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.locationbundle.formhandler');
            $formHandler->create($location);

            return new RedirectResponse($this->generateUrl('backend_location_index'));
        }
        return $this->render('@Location/Default/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction($id)
    {
        $formHandler = $this->get('asiel.locationbundle.formhandler');
        $formHandler->delete($formHandler->find($id));
        return new Response('Command received.');
    }
}
