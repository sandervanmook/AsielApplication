<?php

namespace Asiel\Shared\Test\DataFixtures;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStatusData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $status = new Found(new AnimalStateMachine());
        $status->setArchived(false);
        $status->setDate(new DateTime('now'));

        $manager->persist($status);
        $manager->flush();
    }
}

