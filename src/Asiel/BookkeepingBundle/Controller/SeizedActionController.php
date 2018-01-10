<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Seized;
use Asiel\AnimalBundle\Form\StatusType\SeizedType;
use Asiel\BookkeepingBundle\Service\ActionFormHandler;
use Asiel\BookkeepingBundle\Service\SeizedActionFormHandler;
use Asiel\CustomerBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeizedActionController extends Controller
{
    private $seizedActionFormHandler;
    private $actionFormHandler;

    public function __construct(SeizedActionFormHandler $seizedActionFormHandler, ActionFormHandler $actionFormHandler)
    {
        $this->seizedActionFormHandler = $seizedActionFormHandler;
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
            $this->seizedActionFormHandler->needCustomerToProceedMessage();
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_index'));
        }

        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $this->seizedActionFormHandler->findAnimal($animalId);
        $currentCustomer = $this->seizedActionFormHandler->findCustomer($customerId);

        // Check if the animal has open actions
        if ($currentAnimal->hasOpenActions()) {
            $this->actionFormHandler->hasOpenActionsMessage();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index'));
        }

        // Check if animals active state allows to be changed to adopted
        if (!$this->seizedActionFormHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        $status = new Seized(new AnimalStateMachine());
        $form = $this->createForm(SeizedType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $actionTotalCosts = $form->get('totalcosts')->getData();
            $action = $this->seizedActionFormHandler->createAction($currentAnimal, $currentCustomer, $actionTotalCosts ,$status);
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/SeizedAction/start.html.twig', [
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
        $action = $this->seizedActionFormHandler->findAction($actionid);

        // Verify action is finished
        $this->seizedActionFormHandler->verifyFinish($action);

        // Set the right active status on the animal
        $this->seizedActionFormHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
    }

}