<?php


namespace Asiel\Shared\Test\Filter\Customer;


use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\Shared\Filter\Customer\CustomerFilter;

class CustomerFilterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        new CustomerFilter([], []);
    }

    public function test_lastname_filter()
    {
        $customer = new PrivateCustomer();
        $customer->setLastname('van Mook');
        $allCustomers = [$customer];
        $searchArray['lastname'] = 'Mo';

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $result = $filterCustomer->getFilterResult();

        $this->assertEquals($result, [$customer]);
    }

    public function test_belgium_citizenservicenumber_filter()
    {
        $customer = new PrivateCustomer();
        $customer->setCitizenServiceNumber(123456);
        $allCustomers = [$customer];
        $searchArray['citizenservicenumber'] = 123456;

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $result = $filterCustomer->getFilterResult();

        $this->assertEquals($result, [$customer]);
    }

    public function test_dutch_citizenservicenumber_filter()
    {
        $customer = new PrivateCustomer();
        $customer->setCitizenServiceNumber('233gfasf63');
        $allCustomers = [$customer];
        $searchArray['citizenservicenumber'] = '233gfasf63';

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $result = $filterCustomer->getFilterResult();

        $this->assertEquals($result, [$customer]);
    }
}
