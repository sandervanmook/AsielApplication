<?php

namespace Asiel\FrontendBundle\Controller;

use Asiel\FrontendBundle\Form\ContactType;
use Asiel\FrontendBundle\Form\SearchAnimalType;
use Asiel\FrontendBundle\Service\DefaultFormHandler;
use Asiel\Shared\Filter\Animal\AnimalFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $defaultFormHandler;

    public function __construct(DefaultFormHandler $defaultFormHandler)
    {
        $this->defaultFormHandler = $defaultFormHandler;
    }

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
        $form = $this->createForm(SearchAnimalType::class);

        return $this->render('@Frontend/Default/searchAnimal.html.twig', [
            'form'  => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAnimalsDataAction(Request $request)
    {
        $allPublicAnimals = $this->defaultFormHandler->getAnimalRepository()->allPublicAnimals();

        $searchArray['type'] = $request->get('type');
        $searchArray['gender'] = $request->get('gender');
        $searchArray['agestart'] = $request->get('agestart');
        $searchArray['ageend'] = $request->get('ageend');
        $searchArray['status']  = $request->get('status');
        $searchArray['sterilized']  = $request->get('sterilized');

        $filterAnimal = new AnimalFilter($allPublicAnimals, $searchArray);
        $filterAnimal->filter();

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
        $settings = $this->getDoctrine()->getRepository('BackendBundle:FrontendSettings')->find(1);

        return $this->render('@Frontend/Default/about.html.twig', [
            'info' => $settings,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function contactAction(Request $request)
    {
        $settings = $this->getDoctrine()->getRepository('BackendBundle:FrontendSettings')->find(1);

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->defaultFormHandler->sendContactFormEmail($form);

            return new RedirectResponse($this->generateUrl('frontend_contact'));
        }
        return $this->render('@Frontend/Default/contact.html.twig', [
            'form' => $form->createView(),
            'info' => $settings,
        ]);
    }

    /**
     * @return Response
     */
    public function renderHeaderAction()
    {
        $repository = $this->getDoctrine()->getRepository('BackendBundle:FrontendSettings');
        $settings = $repository->find(1);

        return $this->render('@Frontend/Base/Header.html.twig', [
            'info' => $settings,
        ]);
    }

    /**
     * @return Response
     */
    public function renderFooterAction()
    {
        $repository = $this->getDoctrine()->getRepository('BackendBundle:FrontendSettings');
        $settings = $repository->find(1);

        return $this->render('@Frontend/Base/Footer.html.twig', [
            'info' => $settings,
        ]);
    }

}
