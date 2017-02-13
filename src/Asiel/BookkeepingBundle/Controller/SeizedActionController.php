<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Seized;
use Asiel\AnimalBundle\Form\StatusType\SeizedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeizedActionController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function startAction(Request $request)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.seizedactionformhandler');
        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $formHandler->findAnimal($animalId);
        $currentCustomer = $formHandler->findCustomer($customerId);

        // Check if animals active state allows to be changed to adopted
        if (!$formHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        // Get type of animal the costs are based upon
        $animalType = $formHandler->getAnimalType($currentAnimal);

        $status = new Seized(new AnimalStateMachine());
        $form = $this->createForm(SeizedType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $actionTotalCosts = $form->get('totalcosts')->getData();
            $action = $formHandler->createAction($currentAnimal, $currentCustomer, $actionTotalCosts ,$status);
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/SeizedAction/start.html.twig', [
            'animaltype' => $animalType,
            'animal' => $currentAnimal,
            'customer' => $currentCustomer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $actionid
     * @return RedirectResponse
     */
    public function finishAction(int $actionid)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.seizedactionformhandler');
        $action = $formHandler->findAction($actionid);

        // Verify action is finished
        $formHandler->verifyFinish($action);

        // Set the right active status on the animal
        $formHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
    }

}