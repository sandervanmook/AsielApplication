<?php


namespace Asiel\Shared\Filter\Customer;


use Iterator;

class CustomerMunicipalityFilter extends \FilterIterator
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
            ($value->getMunicipality() == $this->searchArray['municipality'])) {
            return $value;
        }

        return false;
    }
}