<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\AnimalBundle\Form\SearchAnimalType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends Controller
{
    /**
     * @return Response
     */
    public function searchAnimalAction()
    {
        $form = $this->createForm(SearchAnimalType::class);

        return $this->render('@Bookkeeping/Backend/Action/searchAnimal.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchCustomerAction(Request $request)
    {
        $form = $this->createForm(SearchCustomerType::class);

        // Save selected animal in session
        $this->get('session')->set('bookkeeping_selected_animal_id', $request->get('animalid'));

        return $this->render('@Bookkeeping/Backend/Action/searchCustomer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function selectActionAction(Request $request)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.actionformhandler');
        $animalId = $this->get('session')->get('bookkeeping_selected_animal_id');

        // Save selected customer in session
        if (!is_null($request->get('customerid'))) {
            $this->get('session')->set('bookkeeping_selected_customer_id', $request->get('customerid'));
        }

        $currentAnimal = $formHandler->findAnimal($animalId);

        if ($currentAnimal->hasOpenActions()) {
            $formHandler->hasOpenActionsMessage();

            return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_index'));
        }

        return $this->render('@Bookkeeping/Backend/Action/selectAction.html.twig');
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('BookkeepingBundle:Action');
        $allActions = $repository->findAll();

        return $this->render('@Bookkeeping/Backend/Action/index.html.twig', [
            'actions' => $allActions,
        ]);
    }

    /**
     * @param int $actionid
     * @return Response
     */
    public function showAction(int $actionid)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.actionformhandler');
        $action = $formHandler->findAction(($actionid));

        switch ($action->getType()) {
            case 'Adopted' :
                $template = '@Bookkeeping/Backend/AdoptedAction/show.html.twig';
                break;
            case 'Abandoned' :
                $template = '@Bookkeeping/Backend/AbandonedAction/show.html.twig';
                break;
            default:
                throw new \InvalidArgumentException('Unknown type');
        }

        return $this->render($template, [
            'action' => $action,
        ]);
    }
}