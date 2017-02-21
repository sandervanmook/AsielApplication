<?php

namespace Asiel\LocationBundle\DataFixtures\ORM;

use Asiel\LocationBundle\Entity\Location;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadLocationData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $location = new Location();
        $location->setName('Kamer 1');
        $location->setAnimalType('Dog');

        $location2 = new Location();
        $location2->setName('Kamer 2');
        $location2->setAnimalType('Cat');

        $manager->persist($location);
        $manager->persist($location2);

        $manager->flush();
    }
}