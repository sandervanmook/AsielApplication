<?php


namespace Asiel\BackendBundle\Controller;


use Asiel\BackendBundle\Form\BookkeepingSettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{
    public function bookkeepingAction(Request $request)
    {
        /**
         * Always use id 1 as we only want 1 version of the settings.
         * Datafixture makes sure id 1 is already available as we start using the app.
         */
        $formHandler = $this->get('asiel.backendbundle.settingsformhandler');
        $repository = $this->getDoctrine()->getRepository('BackendBundle:BookkeepingSettings');
        $settings = $repository->find(1);

        $form = $this->createForm(BookkeepingSettingsType::class, $settings);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler->edit();

            return new RedirectResponse($this->generateUrl('backend_settings_bookkeeping'));
        }

        return $this->render('@Backend/Settings/Bookkeeping.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}