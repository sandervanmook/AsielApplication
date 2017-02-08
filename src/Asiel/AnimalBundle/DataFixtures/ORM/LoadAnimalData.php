<?php

namespace Asiel\AnimalBundle\DataFixtures\ORM;

use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAnimalData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $animal  = new Cat();
        $animal->setName('Sam');
        $animal->setGender('Male');
        $animal->setRace('test');
        $animal->setRegisterDate(new \DateTime('now'));
        $animal->setAdmissionDate(new \DateTime('now'));
        $animal->setDayOfBirth(new \DateTime('yesterday'));
        $animal->setOutsideAnimal('Ja');
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

        $animal2  = new Dog();
        $animal2->setName('Sammy');
        $animal2->setGender('Female');
        $animal2->setRace('test');
        $animal2->setRegisterDate(new \DateTime('now'));
        $animal2->setAdmissionDate(new \DateTime('now'));
        $animal2->setDayOfBirth(new \DateTime('yesterday'));
        $animal2->setOutsideAnimal('Ja');
        $animal2->setNotChipped(true);
        $animal2->setColour('Rood');
        $animal2->setCompatibleChildrenAbove7y(true);
        $animal2->setCompatibleChildrenAbove10y(true);
        $animal2->setCompatibleChildrenBelow7y(true);
        $animal2->setCompatibleChildrenBelow10y(true);
        $animal2->setCompatibleOldPeople(true);
        $animal2->setVisiblePublic(false);
        $animal2->setAge();
        $animal2->setEscapesAlot(false);
        $animal2->setChipnumber(123456789012344);
        $animal2->setSterilized(false);
        $animal2->setToiletTrained(true);
        $animal2->setNeedsExercise(true);
        $animal2->setFurType('zacht');


        $manager->persist($animal2);

        $manager->flush();
    }
}