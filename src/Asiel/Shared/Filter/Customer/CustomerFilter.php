<?php


namespace Asiel\Shared\Filter\Customer;


class CustomerFilter
{
    private $allCustomers;
    private $searchArray;
    private $filterResult;

    public function __construct($allCustomers, $searchArray)
    {
        $this->allCustomers = $allCustomers;
        $this->searchArray = $searchArray;
    }

    public function getFilterResult()
    {
        return $this->filterResult;
    }

    public function filter()
    {
        $this->filterLastname();
        $this->filterCity();
        $this->filterCitizenServiceNumber();
    }

    /**
     * Main filters use allCustomers
     */

    private function filterLastname()
    {
        $result = [];
        if ((!empty($this->searchArray['lastname'])) && (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if (is_int(stripos($customer->getLastName(), $this->searchArray['lastname']))) {
                    $result[] = $customer;
                }
                $this->filterResult = $result;
            }
        }
    }

    private function filterCitizenServiceNumber()
    {
        $result = [];
        if ((!empty($this->searchArray['citizenservicenumber'])) && (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if ($customer->getCitizenServiceNumber() == $this->searchArray['citizenservicenumber']) {
                    $result[] = $customer;
                }
                $this->filterResult = $result;
            }
        }
    }

    /**
     * Subfilters use filterResult
     */

    private function filterCity()
    {
        $result = [];
        if ((!empty($this->searchArray['city'])) && (!empty($this->filterResult))) {
            foreach ($this->filterResult as $customer) {
                if (is_int(stripos($customer->getCity(), $this->searchArray['city']))) {
                    $result[] = $customer;
                }
                $this->filterResult = $result;
            }
        }
    }
}