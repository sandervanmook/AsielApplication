<?php

namespace Asiel\Shared\Test\DataFixtures;

use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAnimalData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $animal  = new Cat();
        $animal->setName('Sam');
        $animal->setGender('Male');
        $animal->setRegisterDate(new \DateTime('now'));
        $animal->setAdmissionDate(new \DateTime('now'));
        $animal->setDayOfBirth(new \DateTime('yesterday'));
        $animal->setOutsideAnimal(true);
        $animal->setNotChipped(true);
        $animal->setColour('Rood');
        $animal->setCompatibleChildrenAbove7y(true);
        $animal->setCompatibleChildrenAbove10y(true);
        $animal->setCompatibleChildrenBelow7y(true);
        $animal->setCompatibleChildrenBelow10y(true);
        $animal->setCompatibleOldPeople(true);
        $animal->setVisiblePublic(false);
        $animal->setAge();
        $animal->setEscapesAlot(false);
        $animal->setChipnumber(123456789012345);
        $animal->setSterilized(false);
        $animal->setToiletTrained(true);

        $manager->persist($animal);
        $manager->flush();
    }
}