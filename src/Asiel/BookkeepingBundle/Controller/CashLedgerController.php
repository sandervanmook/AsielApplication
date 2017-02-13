<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Filter\CashLedgerFilter;
use Asiel\BookkeepingBundle\Form\CashLedgerSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CashLedgerController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(CashLedgerSearchType::class);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();
            $searchArray['showall'] = $form->get('showall')->getData();

            $allCashTransactions = $this->getDoctrine()->getRepository('BookkeepingBundle:Transaction')->findBy(['paymentType' => 'Cash']);

            $filter = new CashLedgerFilter($allCashTransactions, $searchArray);
            $filter->filter();

            if ($searchArray['showall']) {
                $result = $allCashTransactions;
            } else {
                $result = $filter->getFilterResult();
            }

            return $this->render('@Bookkeeping/Backend/CashLedger/index.html.twig', [
                'form' => $form->createView(),
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'result' => $result,
            ]);
        }


        return $this->render('@Bookkeeping/Backend/CashLedger/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}