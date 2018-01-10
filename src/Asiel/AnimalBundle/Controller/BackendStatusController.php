<?php

namespace Asiel\AnimalBundle\Controller;

use Asiel\AnimalBundle\Form\NewStatusType;
use Asiel\AnimalBundle\Service\StatusFormHandler;
use Asiel\AnimalBundle\StatusFactory\StatusFactory;
use Asiel\AnimalBundle\StatusFactory\StatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BackendStatusController extends Controller
{
    private $statusFormHandler;

    public function __construct(StatusFormHandler $statusFormHandler)
    {
        $this->statusFormHandler = $statusFormHandler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function indexAction(int $id)
    {
        $this->statusFormHandler->checkNoState($id);

        return $this->render('@Animal/Backend/Status/index.html.twig', [
            'result' => $this->statusFormHandler->getRepository()->findBy(['animal' => $this->statusFormHandler->getAnimalRepository()->find($id)],
                ['id' => 'DESC']),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, int $id)
    {
        $form = $this->createForm(NewStatusType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->get('type')->getData();

            if (!$this->statusFormHandler->createStatusTypeCheck($id, $type)) {
                return new RedirectResponse($this->generateUrl('backend_animal_status_create', ['id' => $id]));
            } else {
                return new RedirectResponse($this->generateUrl('backend_animal_status_create_type',
                    ['id' => $id, 'type' => $type]));
            }
        }

        return $this->render('@Animal/Backend/Status/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @param string $type
     * @return RedirectResponse|Response
     */
    public function createTypeAction(Request $request, int $id, string $type)
    {
        $statusFactory = new StatusFactory();
        $statusType = new StatusType($type);
        $statusProduct = $statusFactory->startFactory($statusType);
        $status = $statusProduct->getEntity();

        $form = $this->createForm($statusProduct->getFormType(), $status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentAnimal = $this->statusFormHandler->getAnimalRepository()->find($id);
            $this->statusFormHandler->createStatus($status, $currentAnimal, $form);

            return new RedirectResponse($this->generateUrl('backend_animal_status_index', ['id' => $id]));
        }
        return $this->render('@Animal/Backend/Status/create' . $statusType . '.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $statusid
     * @return Response
     */
    public function showAction(int $statusid)
    {
        $statusType = $this->statusFormHandler->find($statusid)->getClassName();

        return $this->render('@Animal/Backend/Status/show' . $statusType . '.html.twig',
            [
                'status' => $this->statusFormHandler->find($statusid),
            ]);
    }

    /**
     * @param int $statusid
     * @return Response
     * @internal param int $id
     */
    // not in use atm
//    public function deleteAction(int $statusid)
//    {
//        $formHandler = $this->get('asiel.animalbundle.statusformhandler');
//
//        $selectedStatus = $formHandler->find($statusid);
//        $animalId = $selectedStatus->getAnimal()->getId();
//        $allStates = $formHandler->getAnimalRepository()->find($animalId)->getStatus();
//        $amount = count($allStates);
//
//        // If its an archived status just delete it.
//        if ($selectedStatus->isArchived()) {
//            $formHandler->removeArchivedStatus($selectedStatus);
//
//            return new Response('Command received.');
//        }
//
//        // If there is more than 1 state, we have a choice
//        if ($amount > 1) {
//            // First delete the active one.
//            $formHandler->delete($selectedStatus);
//
//            // If the animal has more then 1 old states we need to make the newest one active.
//            $ids = $formHandler->getIdsFromStates($allStates);
//
//            $newestStateId = max($ids);
//
//            $state = $formHandler->find($newestStateId);
//            $state->setArchived(false);
//
//            $this->getDoctrine()->getManager()->flush();
//            $formHandler->setSuccessMessage('Status verwijderd en nieuwste gearchiveerde status actief gemaakt.');
//        } else {
//            // If the animal has none or 1 old state delete it.
//            $formHandler->removeActiveStatus($selectedStatus);
//        }
//
//        return new Response('Command received.');
//    }

}