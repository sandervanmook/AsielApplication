<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Form\StatusType\FoundType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FoundActionController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function startAction(Request $request)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.foundactionformhandler');
        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');
        $customerId = $this->get('session')->get('bookkeeping_selected_customer_id');
        $currentAnimal = $formHandler->findAnimal($animalId);
        $currentCustomer = $formHandler->findCustomer($customerId);

        // Check if animals active state allows to be changed to adopted
        if (!$formHandler->stateChangeAllowed($currentAnimal)) {
            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_select',
                ['animalid' => $animalId]));
        }

        $status = new Found(new AnimalStateMachine());
        $form = $this->createForm(FoundType::class, $status);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $action = $formHandler->createAction($currentAnimal, $currentCustomer, 0 ,$status);
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
}