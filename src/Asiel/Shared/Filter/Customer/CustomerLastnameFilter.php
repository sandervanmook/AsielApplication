<?php


namespace Asiel\Shared\Filter\Customer;


use Asiel\Shared\Validation\CustomerValidation;
use Iterator;

class CustomerLastnameFilter extends \FilterIterator
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

        if (($value->isPrivate()) &&
            (is_int(stripos($value->getLastName(), $this->searchArray['lastname'])))) {
            return $value;
        }

        return false;
    }
}