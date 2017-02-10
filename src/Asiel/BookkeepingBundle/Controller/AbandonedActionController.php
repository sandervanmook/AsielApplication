<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Form\StatusType\AbandonedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbandonedActionController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function startAction(Request $request)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.abandonedactionformhandler');
        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $formHandler->findAnimal($animalId);
        $currentCustomer = $formHandler->findCustomer($customerId);

        // Check if animals active state allows to be changed to adopted
        if (!$formHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        // Get total costs from backend bundle
        $actionTotalCosts = $formHandler->getTotalActionCosts($currentAnimal);

        // Get type of animal the costs are based upon
        $animalType = $formHandler->getAnimalType($currentAnimal);

        $status = new Abandoned(new AnimalStateMachine());
        $form = $this->createForm(AbandonedType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $action = $formHandler->createAction($currentAnimal, $currentCustomer, $actionTotalCosts ,$status);
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/AbandonedAction/start.html.twig', [
            'actiontotalcosts' => $actionTotalCosts,
            'animaltype' => $animalType,
            'animal' => $currentAnimal,
            'customer' => $currentCustomer,
            'form' => $form->createView(),
        ]);
    }

    public function finishAction(int $actionid)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.abandonedactionformhandler');
        $action = $formHandler->findAction($actionid);

        // Verify action is finished
        $formHandler->verifyFinish($action);

        // Set the right active status on the animal
        $formHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));

    }
}