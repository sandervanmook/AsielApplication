<?php

namespace Asiel\Shared\Test\DataFixtures;

use Asiel\EmployeeBundle\Entity\User;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');
        $userAdmin->setIsActive(true);
        $userAdmin->setEmail('admin@gmail.com');
        $userAdmin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $userAdmin->setFirstname('admin');
        $userAdmin->setLastname('admin');
        $userAdmin->setCitizenServiceNumber(11111111);
        $userAdmin->setDayOfBirth(new DateTime('now'));
        $userAdmin->setAddress('admin');
        $userAdmin->setHouseNumber(1);
        $userAdmin->setZipcode('0000aa');
        $userAdmin->setCity('-');
        $userAdmin->setCountry('Nederland');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}