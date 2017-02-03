<?php

namespace Asiel\Shared\TestTools\DataFixtures;

use Asiel\CustomerBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCustomerData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $customer  = new Customer();
        $customer->setFirstname('Jan');
        $customer->setLastname('de Tester');
        $customer->setDayOfBirth(new \DateTime('now'));
        $customer->setCitizenServiceNumber(1111);
        $customer->setEmail('test@example.com');
        $customer->setPhone(12345);
        $customer->setAddress('Buiten');
        $customer->setHouseNumber(1);
        $customer->setZipcode('4700AA');
        $customer->setCity('Roosendaal');
        $customer->setMunicipality('Roosendaal');
        $customer->setCountry('Netherlands');
        $customer->setBlacklisted(false);


        $manager->persist($customer);
        $manager->flush();
    }
}