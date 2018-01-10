<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Form\StatusType\AbandonedType;
use Asiel\BookkeepingBundle\Service\AbandonedActionFormHandler;
use Asiel\BookkeepingBundle\Service\ActionFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbandonedActionController extends Controller
{
    private $abandonedActionFormHandler;
    private $actionFormHandler;

    public function __construct(AbandonedActionFormHandler $abandonedActionFormHandler, ActionFormHandler $actionFormHandler)
    {
        $this->abandonedActionFormHandler = $abandonedActionFormHandler;
        $this->actionFormHandler = $actionFormHandler;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function startAction(Request $request)
    {
        // If the user didn't select a customer, we cannot continue
        if ($this->get('session')->get('bookkeeping_selected_customer_id') == 'unknown') {
            $this->abandonedActionFormHandler->needCustomerToProceedMessage();
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_index'));
        }

        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $this->abandonedActionFormHandler->findAnimal($animalId);
        $currentCustomer = $this->abandonedActionFormHandler->findCustomer($customerId);

        // Check if the animal has open actions
        if ($currentAnimal->hasOpenActions()) {
            $this->actionFormHandler->hasOpenActionsMessage();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index'));
        }

        // Check if animals active state allows to be changed to abandoned
        if (!$this->abandonedActionFormHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        $status = new Abandoned(new AnimalStateMachine());
        $form = $this->createForm(AbandonedType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $action = $this->abandonedActionFormHandler->createAction($currentAnimal, $currentCustomer, $status);
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/AbandonedAction/start.html.twig', [
            'animal' => $currentAnimal,
            'customer' => $currentCustomer,
            'form' => $form->createView(),
        ]);
    }

    public function finishAction(int $actionid)
    {
        $action = $this->abandonedActionFormHandler->findAction($actionid);

        // Verify action is finished
        $this->abandonedActionFormHandler->verifyFinish($action);

        // Set the right active status on the animal
        $this->abandonedActionFormHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
    }
}