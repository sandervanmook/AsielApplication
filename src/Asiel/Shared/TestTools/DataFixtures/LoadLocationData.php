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

        $manager->persist($location);
        $manager->flush();
    }
}