<?php


namespace Asiel\BookkeepingBundle\Controller;


use Asiel\BookkeepingBundle\Filter\BankLedgerFilter;
use Asiel\BookkeepingBundle\Form\BankLedgerSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BankLedgerController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(BankLedgerSearchType::class);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $searchArray['datestart'] = $form->get('datestart')->getData();
            $searchArray['dateend'] = $form->get('dateend')->getData();
            $searchArray['showall'] = $form->get('showall')->getData();

            $allBankTransactions = $this->getDoctrine()->getRepository('BookkeepingBundle:Transaction')->findBy(['paymentType' => 'Bank']);

            $filter = new BankLedgerFilter($allBankTransactions, $searchArray);
            $filter->filter();

            if ($searchArray['showall']) {
                $result = $allBankTransactions;
            } else {
                $result = $filter->getFilterResult();
            }

            return $this->render('@Bookkeeping/Backend/BankLedger/index.html.twig', [
                'form' => $form->createView(),
                'datestart' => $searchArray['datestart']->format('d-m-Y'),
                'dateend' => $searchArray['dateend']->format('d-m-Y'),
                'result' => $result,
            ]);
        }

        return $this->render('@Bookkeeping/Backend/BankLedger/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}