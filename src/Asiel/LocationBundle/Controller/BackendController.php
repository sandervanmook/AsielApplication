<?php

namespace Asiel\LocationBundle\Controller;

use Asiel\LocationBundle\Entity\Location;
use Asiel\LocationBundle\Form\LocationType;
use Asiel\LocationBundle\Service\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BackendController extends Controller
{
    private $formHandler;

    public function __construct(FormHandler $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    public function indexAction()
    {
        return $this->render('@Location/Default/index.html.twig', [
            'alllocations' => $this->getDoctrine()->getRepository('LocationBundle:Location')->findAll(),
        ]);
    }

    public function createAction(Request $request)
    {
        try {$this->denyAccessUnlessGranted('create', null);
        } catch (AccessDeniedException $e) {
            $this->formHandler->accessDeniedMessage();
            exit;
        }

        $location = new Location();

        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->formHandler->create($location);

            return new RedirectResponse($this->generateUrl('backend_location_index'));
        }
        return $this->render('@Location/Default/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction($id)
    {
        try {$this->denyAccessUnlessGranted('delete', null);
        } catch (AccessDeniedException $e) {
            $this->formHandler->accessDeniedMessage();
            exit;
        }

        $this->formHandler->delete($this->formHandler->find($id));
        return new Response('Command received.');
    }
}
