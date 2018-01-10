<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\BookkeepingBundle\Form\TransactionType;
use Asiel\BookkeepingBundle\Service\TransactionFormHandler;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    private $transactionFormHandler;

    public function __construct(TransactionFormHandler $transactionFormHandler)
    {
        $this->transactionFormHandler = $transactionFormHandler;
    }

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
        $action = $this->transactionFormHandler->findAction($request->get('actionid'));
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
        $customerId = $request->get('customerid');
        $actionId = $this->get('session')->get('bookkeeping_selected_action_id');

        $action = $this->transactionFormHandler->findAction($actionId);
        $customer = $this->transactionFormHandler->findCustomer($customerId);

        $transaction = new Transaction();

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('paidAmount')->getData() > $action->sumRemaining()) {
                $this->transactionFormHandler->sumLargerThanRemainingMessage();
            } else {
                $this->transactionFormHandler->create($action, $customer, $transaction);

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
        $transaction = $this->transactionFormHandler->findTransaction($transactionid);

        return $this->render('@Bookkeeping/Backend/Transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @param int $transactionid
     * @return RedirectResponse
     */
    public function payAction(int $transactionid)
    {
        $transaction = $this->transactionFormHandler->findTransaction($transactionid);
        $this->transactionFormHandler->payTransaction($transaction);

        return new RedirectResponse($this->generateUrl('backend_bookkeeping_transaction_show', ['transactionid' => $transactionid]));
    }

    /**
     * @param int $transactionid
     * @return Response
     */
    public function printSingleInvoiceAction(int $transactionid)
    {
        $transaction = $this->transactionFormHandler->findTransaction($transactionid);
        $frondendSettings = $this->getDoctrine()->getRepository('BackendBundle:FrontendSettings')->find(1);
        $bookkeepingSettings = $this->getDoctrine()->getRepository('BackendBundle:BookkeepingSettings')->find(1);

        return $this->render('@Bookkeeping/Backend/Transaction/singleInvoice.html.twig', [
            'transaction' => $transaction,
            'frontendsettings' => $frondendSettings,
            'bookkeepingsettings' => $bookkeepingSettings,
        ]);
    }
}