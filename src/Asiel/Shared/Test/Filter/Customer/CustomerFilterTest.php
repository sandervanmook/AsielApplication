<?php


namespace Asiel\Shared\Test\Filter\Customer;


use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Filter\Customer\CustomerFilter;

class FilterCustomerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        new CustomerFilter([], []);
    }

    public function test_lastname_filter()
    {
        $customer = new Customer();
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
        $customer = new Customer();
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
        $customer = new Customer();
        $customer->setCitizenServiceNumber('233gfasf63');
        $allCustomers = [$customer];
        $searchArray['citizenservicenumber'] = '233gfasf63';

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $result = $filterCustomer->getFilterResult();

        $this->assertEquals($result, [$customer]);
    }

    public function test_city_sub_filter()
    {
        $customer = new Customer();
        $customer->setLastname('van Mook');
        $customer->setCity('Roosendaal');
        $allCustomers = [$customer];
        $searchArray['lastname'] = 'Mo';
        $searchArray['city'] = 'Ro';

        $filterCustomer = new CustomerFilter($allCustomers, $searchArray);
        $filterCustomer->filter();

        $result = $filterCustomer->getFilterResult();

        $this->assertEquals($result, [$customer]);
    }
}
