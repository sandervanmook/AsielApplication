<?php

namespace Asiel\FrontendBundle\Controller;

use Asiel\FrontendBundle\Form\ContactType;
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
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $formHandler = $this->get('asiel.frontendbundle.defaultformhandler');

        $searchForm = $formHandler->createSearchForm();
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $result = $formHandler->getAnimalRepository()->searchAnimalsPublic($formHandler->getSearchArray($searchForm), 10);

            return $this->render('@Frontend/Default/searchResult.html.twig', [
                'result'     => $result,
            ]);
        }

        return $this->render('@Frontend/Default/searchForm.html.twig', [
            'searchform' => $searchForm->createView(),
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

        return $this->render('@Frontend/Default/searchResult.html.twig', [
            'result'     => $result,
        ]);
    }

}
