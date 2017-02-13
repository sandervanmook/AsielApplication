<?php


namespace Asiel\BookkeepingBundle\Filter;


class CashLedgerFilter
{
    private $allTransactions;
    private $searchArray;
    private $filterResult;

    public function __construct($allTransactions, $searchArray)
    {
        $this->allTransactions = $allTransactions;
        $this->searchArray = $searchArray;
    }

    public function getFilterResult()
    {
        return $this->filterResult;
    }

    public function filter()
    {
        $this->filterDate();
    }

    /**
     * First filter, use allActions
     */
    private function filterDate()
    {
        $result = [];
        $dateStart = $this->searchArray['datestart']->getTimestamp();
        $dateEnd = $this->searchArray['dateend']->getTimestamp();

        if (!empty($this->allTransactions)) {
            foreach ($this->allTransactions as $transaction) {
                $registerDate = $transaction->getDate()->getTimestamp();
                if (($registerDate >= $dateStart) &&
                    ($registerDate <= $dateEnd)
                ) {
                    $result[] = $transaction;
                }
            }
            $this->filterResult = $result;
        }
    }
}