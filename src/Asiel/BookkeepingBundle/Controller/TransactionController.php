<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\BookkeepingBundle\Form\TransactionType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function searchCustomerAction(Request $request)
    {
        $form = $this->createForm(SearchCustomerType::class);

        // Save action id in session
        $this->get('session')->set('bookkeeping_selected_action_id', $request->get('actionid'));

        // Show the customer that belongs to the action as separate option so we don't have to search
        $formHandler = $this->get('asiel.bookkeepingbundle.transactionformhandler');
        $action = $formHandler->findAction($request->get('actionid'));
        $actionCustomer = $action->getCustomer();

        if (!is_null($actionCustomer)) {
            $actionCustomerId = $action->getCustomer()->getId();
        } else {
            $actionCustomerId = 0;
        }

        return $this->render('@Bookkeeping/Backend/Transaction/searchCustomer.html.twig', [
            'form' => $form->createView(),
            'actioncustomerid' => $actionCustomerId,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        // The customer linked to the action entity can be different than the one chosen for this transation!
        $formHandler = $this->get('asiel.bookkeepingbundle.transactionformhandler');

        $customerId = $request->get('customerid');
        $actionId = $this->get('session')->get('bookkeeping_selected_action_id');

        $action = $formHandler->findAction($actionId);
        $customer = $formHandler->findCustomer($customerId);

        $transaction = new Transaction();

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('paidAmount')->getData() > $action->sumRemaining()) {
                $formHandler->sumLargerThanRemainingMessage();
            } else {
                $formHandler->create($action, $customer, $transaction);

                return new RedirectResponse($this->generateUrl('backend_bookkeeping_action_show', ['actionid' => $actionId]));
            }
        }

        return $this->render('@Bookkeeping/Backend/Transaction/create.html.twig', [
            'action' => $action,
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $transactionid
     * @return Response
     */
    public function showAction(int $transactionid)
    {
        $formHandler = $this->get('asiel.bookkeepingbundle.transactionformhandler');
        $transaction = $formHandler->findTransaction($transactionid);

        return $this->render('@Bookkeeping/Backend/Transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }
}