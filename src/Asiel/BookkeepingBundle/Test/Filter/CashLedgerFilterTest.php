<?php


namespace Asiel\BookkeepingBundle\Test\Filter;


use Asiel\BookkeepingBundle\Entity\Transaction;
use Asiel\BookkeepingBundle\Filter\CashLedgerFilter;

class CashLedgerFilterTest extends \PHPUnit_Framework_TestCase
{
    public function test_date_filter()
    {
        $transaction = new Transaction();
        $transaction->setDate(new \DateTime('today'));
        $searchArray['datestart'] = new \DateTime('yesterday');
        $searchArray['dateend'] = new \DateTime('now');

        $allTransactions = [$transaction];

        $filter = new CashLedgerFilter($allTransactions, $searchArray);
        $filter->filter();
        $result = $filter->getFilterResult();

        $this->assertEquals($result, $allTransactions);
    }
}
