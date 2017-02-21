<?php


namespace Asiel\StatisticsBundle\Test;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Asiel\StatisticsBundle\Stats\AnimalStats;
use DateTime;

class AnimalStatsTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $stats = new AnimalStats([], []);
    }

    public function test_date_filter()
    {
        $cat = new Cat();
        $status = new Found(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setFoundType('Door ons gevangen');
        $status->setFoundMunicipality('As');
        $cat->addStatus($status);

        $allAnimals = [$cat];
        $searchArray['via'] = 'Both';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['As'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'As' => [
                    'Cat' =>
                        [$cat]
                ]
            ];

        $this->assertEquals($result, $expected);
    }

    public function test_via_both_filter()
    {
        $cat = new Cat();
        $status = new Found(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setFoundType('Door ons gevangen');
        $status->setFoundMunicipality('As');
        $cat->addStatus($status);

        $allAnimals = [$cat];
        $searchArray['via'] = 'Both';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['As'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'As' => [
                    'Cat' =>
                        [$cat]
                ]
            ];

        $this->assertEquals($result, $expected);
    }

    public function test_via_found_caught_filter()
    {
        $cat = new Cat();
        $status = new Found(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setFoundType('Door ons gevangen');
        $status->setFoundMunicipality('As');
        $cat->addStatus($status);

        $allAnimals = [$cat];
        $searchArray['via'] = 'Found_Caught';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['As'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'As' => [
                    'Cat' =>
                        [$cat]
                ]
            ];

        $this->assertEquals($result, $expected);
    }

    public function test_via_found_abandoned_filter()
    {
        $cat = new Cat();
        $customer = new PrivateCustomer();
        $customer->setMunicipality('Bree');
        $status = new Abandoned(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setAbandonedBy($customer);
        $cat->addStatus($status);

        $allAnimals = [$cat];
        $searchArray['via'] = 'Abandoned';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['Bree'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'Bree' => [
                    'Cat' =>
                        [$cat]
                ]
            ];

        $this->assertEquals($result, $expected);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_via_no_argument_filter()
    {
        $cat = new Cat();
        $customer = new PrivateCustomer();
        $customer->setMunicipality('Bree');
        $status = new Abandoned(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setAbandonedBy($customer);
        $cat->addStatus($status);

        $allAnimals = [$cat];
        $searchArray['via'] = 'Yolo';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['Bree'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
    }

    public function test_municipality_dog_caught_filter()
    {
        $dog = new Dog();
        $status = new Found(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setFoundType('Door ons gevangen');
        $status->setFoundMunicipality('Bree');
        $dog->addStatus($status);

        $allAnimals = [$dog];
        $searchArray['via'] = 'Found_Caught';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['Bree'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'Bree' => [
                    'Dog' =>
                        [$dog]
                ]
            ]
        ;

        $this->assertEquals($result, $expected);
    }

    public function test_municipality_dog_abandon_filter()
    {
        $dog = new Dog();
        $customer = new PrivateCustomer();
        $customer->setMunicipality('Bree');
        $status = new Abandoned(new AnimalStateMachine());
        $status->setDate(new DateTime('today'));
        $status->setArchived(false);
        $status->setAbandonedBy($customer);
        $dog->addStatus($status);

        $allAnimals = [$dog];
        $searchArray['via'] = 'Abandoned';
        $searchArray['datestart'] = new \DateTime('today');
        $searchArray['dateend'] = new \DateTime('today');
        $searchArray['municipality'] = ['Bree'];

        $stats = new AnimalStats($allAnimals, $searchArray);
        $stats->filter();
        $result = $stats->getFilterResult();

        $expected =
            [
                'Bree' => [
                    'Dog' =>
                        [$dog]
                ]
            ];

        $this->assertEquals($result, $expected);
    }
}
