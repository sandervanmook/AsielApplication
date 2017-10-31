<?php

namespace Asiel\Shared\TestTools\DataFixtures;

use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadBookkeepingSettingsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new BookkeepingSettings();

        $entity->setPriceAdoptedKitten(150);
        $entity->setPriceAdoptedCat(120);
        $entity->setPriceAdoptedPuppy(250);
        $entity->setPriceAdoptedDog(185);
        $entity->setPriceAbandonedDogUnaffiliatedYoungerThanOne(45);
        $entity->setPriceAbandonedDogUnaffiliatedOlderThanOne(65);
        $entity->setPriceAbandonedDogUnaffiliatedPuppy(18);
        $entity->setPriceAbandonedDogUnaffiliatedAdditionNotChipped(30);
        $entity->setPriceAbandonedDogUnaffiliatedAdditionNotVaccinated(20);
        $entity->setPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog(45);
        $entity->setPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog(100);
        $entity->setPriceAbandonedDogUnaffiliatedAdditionIll(35);
        $entity->setPriceAbandonedDogAffiliatedYoungerThanOne(30);
        $entity->setPriceAbandonedDogAffiliatedOlderThanOne(50);
        $entity->setPriceAbandonedDogAffiliatedPuppy(10);
        $entity->setPriceAbandonedDogAffiliatedAdditionNotChipped(15);
        $entity->setPriceAbandonedDogAffiliatedAdditionNotVaccinated(15);
        $entity->setPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog(35);
        $entity->setPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog(80);
        $entity->setPriceAbandonedDogAffiliatedAdditionIll(35);
        $entity->setPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths(20);
        $entity->setPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears(30);
        $entity->setPriceAbandonedCatUnaffiliatedOlderThanTenYears(40);
        $entity->setPriceAbandonedCatUnaffiliatedKitten(10);
        $entity->setPriceAbandonedCatUnaffiliatedAdditionNotChipped(20);
        $entity->setPriceAbandonedCatUnaffiliatedAdditionNotVaccinated(15);
        $entity->setPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization(20);
        $entity->setPriceAbandonedCatAffiliatedYoungerThanThreeMonths(10);
        $entity->setPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears(15);
        $entity->setPriceAbandonedCatAffiliatedOlderThanTenYears(25);
        $entity->setPriceAbandonedCatAffiliatedKitten(5);
        $entity->setPriceAbandonedCatAffiliatedAdditionNotChipped(15);
        $entity->setPriceAbandonedCatAffiliatedAdditionNotVaccinated(15);
        $entity->setPriceAbandonedCatAffiliatedAdditionNeedsSterilization(15);
        $entity->setPriceFoundFee(75);
        $entity->setPriceFoundNotChipped(42);
        $entity->setPriceFoundNotVaccinated(18);
        $entity->setPriceFoundDeWorm(10);
        $entity->setPriceFoundTenancyPerDay(18.15);
        $entity->setIban(11111);
        $entity->setBic('abn123');
        $entity->setInvoiceEmailAddress('test@test.nl');


        $manager->persist($entity);
        $manager->flush();
    }
}