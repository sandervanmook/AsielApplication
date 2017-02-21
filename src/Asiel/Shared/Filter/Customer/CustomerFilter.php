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
        $this->filterMunicipality();
        $this->filterCitizenServiceNumber();
        $this->filterCompanyName();
    }

    /**
     * Main filters use allCustomers
     */

    private function filterLastname()
    {
        $result = [];
        if ((!empty($this->searchArray['lastname'])) && (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if (($customer->getClassName() == 'PrivateCustomer') && (is_int(stripos($customer->getLastName(), $this->searchArray['lastname'])))) {
                    $result[] = $customer;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterCitizenServiceNumber()
    {
        $result = [];
        if ((!empty($this->searchArray['citizenservicenumber'])) && (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if (($customer->getClassName() == 'PrivateCustomer') && ($customer->getCitizenServiceNumber() == $this->searchArray['citizenservicenumber'])) {
                    $result[] = $customer;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterMunicipality()
    {
        $result = [];
        if ((!empty($this->searchArray['municipality'])) && (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if (($customer->getClassName() == 'PrivateCustomer') && ($customer->getMunicipality() == $this->searchArray['municipality'])) {
                    $result[] = $customer;
                }
            }
            $this->filterResult = $result;
        }
    }

    private function filterCompanyName()
    {
        $result = [];
        if ((!empty($this->searchArray['companyname'])) &&
            (!empty($this->allCustomers))) {
            foreach ($this->allCustomers as $customer) {
                if (($customer->getClassName() == 'BusinessCustomer') && (is_int(stripos($customer->getCompanyName(), $this->searchArray['companyname'])))) {
                    $result[] = $customer;
                }
            }
            $this->filterResult = $result;
        }
    }

    /**
     * Subfilters use filterResult
     */

}