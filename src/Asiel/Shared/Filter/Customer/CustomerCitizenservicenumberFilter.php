<?php


namespace Asiel\Shared\Filter\Customer;


use Iterator;

class CustomerCitizenservicenumberFilter extends \FilterIterator
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
        if (($value->getClassName() == 'PrivateCustomer') &&
            ($value->getCitizenServiceNumber() == $this->searchArray['citizenservicenumber'])) {
            return $value;
        }

        return false;
    }
}