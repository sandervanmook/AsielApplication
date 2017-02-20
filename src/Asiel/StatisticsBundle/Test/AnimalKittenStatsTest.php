<?php


namespace Asiel\StatisticsBundle\Test;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Entity\StatusType\Seized;
use Asiel\StatisticsBundle\Stats\AnimalKittenStats;

class AnimalKittenStatsTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $stats = new AnimalKittenStats([], []);
    }

    public function test_date_filter()
    {
        $cat1 = new Cat();
        $cat2 = new Cat();
        $dog1 = new Dog();

        $cat1->setDayOfBirth(new \DateTime('yesterday'));
        $cat2->setDayOfBirth(new \DateTime('yesterday'));
        $dog1->setDayOfBirth(new \DateTime('yesterday'));

        $cat1->setAdmissionDate(new \DateTime('now'));
        $cat2->setAdmissionDate(new \DateTime('now'));
        $dog1->setAdmissionDate(new \DateTime('now'));

        $allAnimals = [$cat1, $cat2, $dog1];
        $searchArray['datestart'] = new \DateTime('1-1-2012');
        $searchArray['dateend'] = new \DateTime('now');

        $stats = new AnimalKittenStats($allAnimals, $searchArray);
        $stats->filter();

        $result = $stats->getFilterResult();
        $expected = 3;

        $this->assertEquals($result, $expected);
    }
}
