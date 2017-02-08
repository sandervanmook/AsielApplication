<?php

namespace Asiel\BackendBundle\DataFixtures\ORM;

use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadBookkeepingSettingsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new BookkeepingSettings();

        $entity->setPriceAdoptedKitten(200);
        $entity->setPriceAdoptedCat(200);
        $entity->setPriceAdoptedPuppy(200);
        $entity->setPriceAdoptedDog(200);
        $entity->setPriceAbandonedKitten(200);
        $entity->setPriceAbandonedCat(200);
        $entity->setPriceAbandonedPuppy(200);
        $entity->setPriceAbandonedDog(200);

        $manager->persist($entity);
        $manager->flush();
    }
}