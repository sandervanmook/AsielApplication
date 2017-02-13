<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Filter\InvoiceLedgerFilter;
use Asiel\BookkeepingBundle\Form\InvoiceLedgerSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}