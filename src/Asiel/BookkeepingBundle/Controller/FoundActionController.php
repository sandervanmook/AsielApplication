<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Form\StatusType\FoundType;
use Asiel\BookkeepingBundle\Form\FoundExtraCostsType;
use Asiel\BookkeepingBundle\Service\ActionFormHandler;
use Asiel\BookkeepingBundle\Service\FoundActionFormHandler;
use Asiel\CustomerBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FoundActionController extends Controller
{
    private $foundActionFormHandler;
    private $actionFormHandler;

    public function __construct(FoundActionFormHandler $foundActionFormHandler, ActionFormHandler $actionFormHandler)
    {
        $this->foundActionFormHandler = $foundActionFormHandler;
        $this->actionFormHandler = $actionFormHandler;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function startAction(Request $request)
    {
        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $this->foundActionFormHandler->findAnimal($animalId);

        if ($customerId != 'unknown') {
            $currentCustomer = $this->foundActionFormHandler->findCustomer($customerId);
        } else {
            $currentCustomer = new Customer();
        }

        // Check if the animal has open actions
        if ($currentAnimal->hasOpenActions()) {
            $this->actionFormHandler->hasOpenActionsMessage();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index'));
        }

        // Check if animals active state allows to be changed to adopted
        if (!$this->foundActionFormHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        $status = new Found(new AnimalStateMachine());
        $form = $this->createForm(FoundType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $action = $this->foundActionFormHandler->createAction($currentAnimal, $currentCustomer, $status);
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/FoundAction/start.html.twig', [
            'animal' => $currentAnimal,
            'customer' => $currentCustomer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $actionid
     * @return RedirectResponse|Response
     */
    public function extraCostsAction(Request $request, int $actionid)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.foundactionformhandler');
        $form = $this->createForm(FoundExtraCostsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $action = $formHandler->findAction($actionid);

            $formValues['sterilization'] = $form->get('sterilization')->getData();
            $formValues['medical'] = $form->get('medical')->getData();
            $formValues['damage'] = $form->get('damage')->getData();
            $formValues['tenancydays'] = $form->get('tenancydays')->getData();

            $formHandler->addExtraCosts($formValues, $action);

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
        }

        return $this->render('@Bookkeeping/Backend/FoundAction/extraCosts.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $actionid
     * @return RedirectResponse
     */
    public function finishAction(int $actionid)
    {
        $action = $this->foundActionFormHandler->findAction($actionid);

        // Verify action is finished
        $this->foundActionFormHandler->verifyFinish($action);

        // Set the right active status on the animal
        $this->foundActionFormHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
    }
}