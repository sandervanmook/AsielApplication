<?php

namespace Asiel\FrontendBundle\Controller;

use Asiel\FrontendBundle\Form\ContactType;
use Asiel\FrontendBundle\SearchAnimal\FilterAnimal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@Frontend/Default/index.html.twig');
    }

    /**
     * @return Response
     */
    public function searchAnimalsAction()
    {
        $formHandler = $this->get('asiel.frontendbundle.defaultformhandler');

        return $this->render('@Frontend/Default/searchAnimal.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAnimalsDataAction(Request $request)
    {
        $formHandler = $this->get('asiel.frontendbundle.defaultformhandler');

        $allPublicAnimals = $formHandler->getAnimalRepository()->allPublicAnimals();

        $searchArray['type'] = $request->get('type');
        $searchArray['gender'] = $request->get('gender');
        $searchArray['agestart'] = $request->get('agestart');
        $searchArray['ageend'] = $request->get('ageend');

        $filterAnimal = new FilterAnimal($allPublicAnimals, $searchArray);

        $endResult = $filterAnimal->getFilterResult();

        return $this->render('@Frontend/Default/searchAnimalResult.html.twig', [
            'result' => $endResult,
        ]);
    }

    /**
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render('@Frontend/Default/about.html.twig');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function contactAction(Request $request)
    {
        $formHandler = $this->get('asiel.frontendbundle.defaultformhandler');

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->sendContactFormEmail($form);

            return new RedirectResponse($this->generateUrl('frontend_contact'));
        }
        return $this->render('@Frontend/Default/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param integer $id
     * @return Response
     */
    public function facebookLinkAction(int $id)
    {
        $formHandler = $this->get('asiel.frontendbundle.defaultformhandler');
        $result = $formHandler->findAnimal($id);

        return $this->render('@Frontend/Default/searchAnimalResult.html.twig', [
            'result' => $result,
        ]);
    }

}
