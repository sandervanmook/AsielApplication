<?php


namespace Asiel\StatisticsBundle\Test;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Entity\StatusType\Deceased;
use Asiel\AnimalBundle\Entity\StatusType\Lost;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;
use Asiel\StatisticsBundle\Stats\AnimalLeavingStats;

class AnimalLeavingStatsTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $stats = new AnimalLeavingStats([], []);
    }

    public function test_date_filter()
    {
        $cat1 = new Cat();
        $cat2 = new Cat();
        $cat3 = new Cat();
        $cat4 = new Cat();
        $cat5 = new Cat();
        $cat6 = new Cat();
        $cat7 = new Cat();
        $cat8 = new Cat();

        $dog1 = new Dog();
        $dog2 = new Dog();
        $dog3 = new Dog();
        $dog4 = new Dog();
        $dog5 = new Dog();
        $dog6 = new Dog();
        $dog7 = new Dog();
        $dog8 = new Dog();

        $deceased = new Deceased(new AnimalStateMachine());
        $returnedOwner = new ReturnedOwner(new AnimalStateMachine());
        $adopted = new Adopted(new AnimalStateMachine());
        $lost = new Lost(new AnimalStateMachine());

        $deceased->setArchived(false);
        $returnedOwner->setArchived(false);
        $adopted->setArchived(false);
        $lost->setArchived(false);

        $now = new \DateTime();
        $twoYearsAgo = $now->modify('-2 year');

        $cat1->setDayOfBirth(new \DateTime('yesterday'));
        $cat2->setDayOfBirth($twoYearsAgo);
        $cat3->setDayOfBirth(new \DateTime('yesterday'));
        $cat4->setDayOfBirth($twoYearsAgo);
        $cat5->setDayOfBirth(new \DateTime('yesterday'));
        $cat6->setDayOfBirth($twoYearsAgo);
        $cat7->setDayOfBirth(new \DateTime('yesterday'));
        $cat8->setDayOfBirth($twoYearsAgo);

        $dog1->setDayOfBirth(new \DateTime('yesterday'));
        $dog2->setDayOfBirth($twoYearsAgo);
        $dog3->setDayOfBirth(new \DateTime('yesterday'));
        $dog4->setDayOfBirth($twoYearsAgo);
        $dog5->setDayOfBirth(new \DateTime('yesterday'));
        $dog6->setDayOfBirth($twoYearsAgo);
        $dog7->setDayOfBirth(new \DateTime('yesterday'));
        $dog8->setDayOfBirth($twoYearsAgo);

        $cat1->setAdmissionDate(new \DateTime('now'));
        $cat2->setAdmissionDate(new \DateTime('now'));
        $cat3->setAdmissionDate(new \DateTime('now'));
        $cat4->setAdmissionDate(new \DateTime('now'));
        $cat5->setAdmissionDate(new \DateTime('now'));
        $cat6->setAdmissionDate(new \DateTime('now'));
        $cat7->setAdmissionDate(new \DateTime('now'));
        $cat8->setAdmissionDate(new \DateTime('now'));

        $dog1->setAdmissionDate(new \DateTime('now'));
        $dog2->setAdmissionDate(new \DateTime('now'));
        $dog3->setAdmissionDate(new \DateTime('now'));
        $dog4->setAdmissionDate(new \DateTime('now'));
        $dog5->setAdmissionDate(new \DateTime('now'));
        $dog6->setAdmissionDate(new \DateTime('now'));
        $dog7->setAdmissionDate(new \DateTime('now'));
        $dog8->setAdmissionDate(new \DateTime('now'));

        $cat1->addStatus($deceased);
        $cat2->addStatus($deceased);
        $cat3->addStatus($returnedOwner);
        $cat4->addStatus($returnedOwner);
        $cat5->addStatus($adopted);
        $cat6->addStatus($adopted);
        $cat7->addStatus($lost);
        $cat8->addStatus($lost);

        $dog1->addStatus($deceased);
        $dog2->addStatus($deceased);
        $dog3->addStatus($returnedOwner);
        $dog4->addStatus($returnedOwner);
        $dog5->addStatus($adopted);
        $dog6->addStatus($adopted);
        $dog7->addStatus($lost);
        $dog8->addStatus($lost);

        $allAnimals = [
            $cat1,
            $cat2,
            $cat3,
            $cat4,
            $cat5,
            $cat6,
            $cat7,
            $cat8,
            $dog1,
            $dog2,
            $dog3,
            $dog4,
            $dog5,
            $dog6,
            $dog7,
            $dog8,
        ];

        $searchArray['datestart'] = new \DateTime('1-1-2012');
        $searchArray['dateend'] = new \DateTime('now');

        $stats = new AnimalLeavingStats($allAnimals, $searchArray);
        $stats->filter();

        $result = $stats->getFilterResult();
        $expected =
            [
                'Deceased' => [
                    'Puppy' => [$dog1],
                    'Dog' => [$dog2],
                    'Kitten' => [$cat1],
                    'Cat' => [$cat2]
                ],
                'ReturnedOwner' => [
                    'Puppy' => [$dog3],
                    'Dog' => [$dog4],
                    'Kitten' => [$cat3],
                    'Cat' => [$cat4]
                ],
                'Adopted' => [
                    'Puppy' => [$dog5],
                    'Dog' => [$dog6],
                    'Kitten' => [$cat5],
                    'Cat' => [$cat6]
                ],
                'Lost' => [
                    'Puppy' => [$dog7],
                    'Dog' => [$dog8],
                    'Kitten' => [$cat7],
                    'Cat' => [$cat8]
                ],
            ];

        $this->assertEquals($result, $expected);
    }
}
