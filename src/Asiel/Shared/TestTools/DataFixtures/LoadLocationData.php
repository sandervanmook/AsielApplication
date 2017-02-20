<?php


namespace Asiel\Shared\TestTools\DataFixtures;


use Asiel\LocationBundle\Entity\Location;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLocationData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $location  = new Location();
        $location->setName('Lokaal 1');
        $location->setAnimalType('Cat');

        $location2  = new Location();
        $location2->setName('Lokaal 2');
        $location2->setAnimalType('Dog');

        $manager->persist($location);
        $manager->persist($location2);
        $manager->flush();
    }
}