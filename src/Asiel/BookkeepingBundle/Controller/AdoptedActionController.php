<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\BookkeepingBundle\Service\ActionFormHandler;
use Asiel\BookkeepingBundle\Service\AdoptedActionFormHandler;
use Asiel\BookkeepingBundle\Service\CalculateTotalCosts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdoptedActionController extends Controller
{
    private $adoptedActionFormHandler;
    private $actionFormHandler;

    public function __construct(AdoptedActionFormHandler $adoptedActionFormHandler, ActionFormHandler $actionFormHandler)
    {
        $this->adoptedActionFormHandler = $adoptedActionFormHandler;
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
            $this->adoptedActionFormHandler->needCustomerToProceedMessage();
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_index'));
        }

        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $this->adoptedActionFormHandler->findAnimal($animalId);
        $currentCustomer = $this->adoptedActionFormHandler->findCustomer($customerId);

        // Check if the animal has open actions
        if ($currentAnimal->hasOpenActions()) {
            $this->actionFormHandler->hasOpenActionsMessage();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index'));
        }

        // Check if animals active state allows to be changed to adopted
        if (!$this->adoptedActionFormHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        $form = $this->createFormBuilder()
            ->add('submit', SubmitType::class, [
                'label' => 'Aanmaken',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $action = $this->adoptedActionFormHandler->createAction($currentAnimal, $currentCustomer, new Adopted(new AnimalStateMachine()));
            $actionId = $action->getId();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show',
                ['actionid' => $actionId]));
        }

        return $this->render('@Bookkeeping/Backend/AdoptedAction/start.html.twig', [
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
        $action = $this->adoptedActionFormHandler->findAction($actionid);

        // Verify action is finished
        $this->adoptedActionFormHandler->verifyFinish($action);

        // Set the right active status on the animal
        $this->adoptedActionFormHandler->setNewStatus($action);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionid]));
    }
}