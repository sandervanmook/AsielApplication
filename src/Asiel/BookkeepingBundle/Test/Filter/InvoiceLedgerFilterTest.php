<?php


namespace Asiel\BookkeepingBundle\Test\Filter;


use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\BookkeepingBundle\Filter\InvoiceLedgerFilter;

class InvoiceLedgerFilterTest extends \PHPUnit_Framework_TestCase
{
    public function test_date_filter()
    {
        $transaction = new Transaction();
        $transaction->setDate(new \DateTime('today'));
        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');

        $allTransactions = [$transaction];

        $filter = new InvoiceLedgerFilter($allTransactions, $searchArray);
        $filter->filter();
        $result = $filter->getFilterResult();

        $this->assertEquals($result, $allTransactions);
    }
}
