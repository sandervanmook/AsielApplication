<?php


namespace Asiel\Shared\Filter\Customer;


use Iterator;

class CustomerCompanynameFilter extends \FilterIterator
{
    private $searchArray;

    public function __construct(Iterator $iterator, array $searchArray)
    {
        parent::__construct($iterator);
        $this->searchArray = $searchArray;
    }

    public function accept()
    {
        $value = $this->current();
        if (($value->isBusiness()) &&
            (is_int(stripos($value->getCompanyName(), $this->searchArray['companyname'])))) {
            return $value;
        }

        return false;
    }
}