<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Filter\InvoiceLedgerFilter;
use Asiel\BookkeepingBundle\Form\InvoiceLedgerSearchType;
use Asiel\CustomerBundle\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceLedgerController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(InvoiceLedgerSearchType::class);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();
            $searchArray['showall'] = $form->get('showall')->getData();

            $allInvoiceTransactions = $this->getDoctrine()->getRepository('BookkeepingBundle:Transaction')->findBy(['paymentType' => 'Invoice']);

            $filter = new InvoiceLedgerFilter($allInvoiceTransactions, $searchArray);
            $filter->filter();

            if ($searchArray['showall']) {
                $result = $allInvoiceTransactions;
            } else {
                $result = $filter->getFilterResult();
            }

            return $this->render('@Bookkeeping/Backend/InvoiceLedger/index.html.twig', [
                'form' => $form->createView(),
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'result' => $result,
            ]);
        }

        return $this->render('@Bookkeeping/Backend/InvoiceLedger/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return Response
     */
    public function searchCustomerAction()
    {
        $form = $this->createForm(SearchCustomerType::class);

        return $this->render('@Bookkeeping/Backend/InvoiceLedger/searchCustomer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function invoicePerCustomerAction(Request $request, int $customerid)
    {
        $form = $this->createFormBuilder()
            ->add('start', DateType::class, [
                'label' => 'Van',
                'format' => 'dMy',
            ])
            ->add('end', DateType::class, [
                'label' => 'Tot',
                'format' => 'dMy',
                'data' => new \DateTime('today'),
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formHandler = $this->get('asiel.bookkeepingbundle.transactionformhandler');

            $start = $form->get('start')->getData()->getTimestamp();
            $end = $form->get('end')->getData()->getTimestamp();
            $customer = $formHandler->findCustomer($customerid);

            $transactions = [];
            $totalCosts = 0;
            foreach ($customer->getTransactions() as $transaction) {
                $transactionDate = $transaction->getDate()->getTimestamp();
                if ($transaction->isInvoice() &&
                    $transactionDate >= $start &&
                    $transactionDate <= $end) {
                    $transactions[] = $transaction;
                    $totalCosts += $transaction->getPaidAmount();
                }
            }

            return $this->render('@Bookkeeping/Backend/InvoiceLedger/invoicePerCustomer.html.twig', [
                'transactions' => $transactions,
                'totalcosts' => $totalCosts,
                'customer' => $customer,
            ]);
        }

        return $this->render('@Bookkeeping/Backend/InvoiceLedger/selectDate.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function printInvoicePerCustomerAction()
    {

    }

}