<?php

namespace Asiel\Shared\TestTools\DataFixtures;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Entity\Picture;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadAnimalData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Animal 1
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
        // Picture for animal
        $picture = new Picture();
        $picture->setAnimal($animal);
        $picture->setUpdatedAt(new DateTime('now'));
        $picture->setPictureName('yolo');
        // Status for animal
        $status = new Found(new AnimalStateMachine());
        $status->setAnimal($animal);
        $status->setDate(new DateTime('now'));
        $status->setArchived(false);
        $status->setFoundMunicipality('Kinrooi');

        // Animal 2
        $animal2  = new Cat();
        $animal2->setName('Sam');
        $animal2->setGender('Male');
        $animal2->setRegisterDate(new \DateTime('now'));
        $animal2->setAdmissionDate(new \DateTime('now'));
        $animal2->setDayOfBirth(new \DateTime('yesterday'));
        $animal2->setOutsideAnimal(true);
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
        $animal2->setChipnumber(123456789012345);
        $animal2->setSterilized(false);
        $animal2->setToiletTrained(true);
        $animal2->setFacebookId('yolo');
        // Incident for animal 2
        $incident = new Incident();
        $incident->setAnimal($animal2);
        $incident->setDate(new \DateTime('now'));
        $incident->setTitle('yolo');
        $incident->setDescription('description');
        // Medical entry for animal 2
        $medical = new Medical();
        $medical->setAnimal($animal2);
        $medical->setDate(new \DateTime('now'));
        $medical->setType('yolo');
        $medical->setDescription('description');

        $manager->persist($picture);
        $manager->persist($status);
        $manager->persist($animal);
        $manager->persist($incident);
        $manager->persist($medical);
        $manager->persist($animal2);

        $manager->flush();
    }
}