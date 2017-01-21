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
        $manager->persist($location);
        $manager->flush();
    }
}