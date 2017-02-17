<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Service\TotalActionCosts;
use DateTime;
use Doctrine\ORM\EntityManager;

class TotalActionCostsTest extends \PHPUnit_Framework_TestCase
{
    public function test_calculate_adopted_kitten()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAdoptedKitten'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAdoptedKitten')
            ->willReturn(20);

        $cat = new Cat();
        $cat->setDayOfBirth(new DateTime('yesterday'));
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Adopted');

        $result = $totalActionCosts->getTotalCosts();

        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_adopted_cat()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAdoptedCat'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAdoptedCat')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $twoYearsAgo = $today->modify('- 2 year');
        $cat->setDayOfBirth($twoYearsAgo);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Adopted');

        $result = $totalActionCosts->getTotalCosts();

        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_adopted_dog()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAdoptedDog'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAdoptedDog')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $twoYearsAgo = $today->modify('- 2 year');
        $dog->setDayOfBirth($twoYearsAgo);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Adopted');

        $result = $totalActionCosts->getTotalCosts();

        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_adopted_puppy()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAdoptedPuppy'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAdoptedPuppy')
            ->willReturn(20);

        $dog = new Dog();
        $dog->setDayOfBirth(new DateTime('yesterday'));
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Adopted');

        $result = $totalActionCosts->getTotalCosts();

        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_dog_older_than_1_year()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getpriceAbandonedDogUnaffiliatedOlderThanOne'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogUnaffiliatedOlderThanOne')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_dog_younger_than_1_year()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getpriceAbandonedDogUnaffiliatedYoungerThanOne'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogUnaffiliatedYoungerThanOne')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $sevenMonthsAgo = $today->modify('- 7 months');
        $dog->setDayOfBirth($sevenMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_dog_puppy()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedDogUnaffiliatedPuppy'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedPuppy')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $twoMonthsAgo = $today->modify('- 2 months');
        $dog->setDayOfBirth($twoMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_dog_older_than_1_year_with_additions_small_dog()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getpriceAbandonedDogUnaffiliatedOlderThanOne',
                'getPriceAbandonedDogUnaffiliatedAdditionNotChipped',
                'getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated',
                'getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog',
                'getPriceAbandonedDogUnaffiliatedAdditionIll'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(5))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(5))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogUnaffiliatedOlderThanOne')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionNotChipped')
            ->willReturn(11);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated')
            ->willReturn(12);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog')
            ->willReturn(13);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionIll')
            ->willReturn(14);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsFurTreatment('smalldog');
        $status->setIsIll(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 60;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_dog_older_than_1_year_with_additions_large_dog()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getpriceAbandonedDogUnaffiliatedOlderThanOne',
                'getPriceAbandonedDogUnaffiliatedAdditionNotChipped',
                'getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated',
                'getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog',
                'getPriceAbandonedDogUnaffiliatedAdditionIll'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(5))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(5))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogUnaffiliatedOlderThanOne')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionNotChipped')
            ->willReturn(11);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionNotVaccinated')
            ->willReturn(12);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog')
            ->willReturn(13);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogUnaffiliatedAdditionIll')
            ->willReturn(14);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsFurTreatment('largedog');
        $status->setIsIll(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 60;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_cat_younger_than_1_month()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatUnaffiliatedKitten'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedKitten')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $oneMonthAgo = $today->modify('- 1 month');
        $cat->setDayOfBirth($oneMonthAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_cat_younger_than_3_month()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $threeMonthsAgo = $today->modify('- 3 month');
        $cat->setDayOfBirth($threeMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_cat_older_than_10_years()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatUnaffiliatedOlderThanTenYears'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedOlderThanTenYears')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $elevenYearsAgo = $today->modify('- 11 years');
        $cat->setDayOfBirth($elevenYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_cat_between_3_months_and_10_years()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $nineYearsAgo = $today->modify('- 9 years');
        $cat->setDayOfBirth($nineYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_no_affiliation_cat_younger_than_3_month_with_additions()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths',
                'getPriceAbandonedCatUnaffiliatedAdditionNotChipped',
                'getPriceAbandonedCatUnaffiliatedAdditionNotVaccinated',
                'getPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(4))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(4))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedYoungerThanThreeMonths')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedAdditionNotChipped')
            ->willReturn(20);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedAdditionNotVaccinated')
            ->willReturn(30);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatUnaffiliatedAdditionNeedsSterilization')
            ->willReturn(40);

        $cat = new Cat();
        $today = new DateTime('today');
        $threeMonthsAgo = $today->modify('- 3 month');
        $cat->setDayOfBirth($threeMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(false);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsSterilization(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 100;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_dog_older_than_1_year()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getpriceAbandonedDogAffiliatedOlderThanOne'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogAffiliatedOlderThanOne')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_dog_younger_than_1_year()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getpriceAbandonedDogAffiliatedYoungerThanOne'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogAffiliatedYoungerThanOne')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $sevenMonthsAgo = $today->modify('- 7 months');
        $dog->setDayOfBirth($sevenMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_dog_puppy()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedDogAffiliatedPuppy'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedPuppy')
            ->willReturn(20);

        $dog = new Dog();
        $today = new DateTime('today');
        $twoMonthsAgo = $today->modify('- 2 months');
        $dog->setDayOfBirth($twoMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_dog_older_than_1_year_with_additions_small_dog()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getpriceAbandonedDogAffiliatedOlderThanOne',
                'getPriceAbandonedDogAffiliatedAdditionNotChipped',
                'getPriceAbandonedDogAffiliatedAdditionNotVaccinated',
                'getPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog',
                'getPriceAbandonedDogAffiliatedAdditionIll'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(5))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(5))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogAffiliatedOlderThanOne')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionNotChipped')
            ->willReturn(11);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionNotVaccinated')
            ->willReturn(12);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog')
            ->willReturn(13);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionIll')
            ->willReturn(14);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsFurTreatment('smalldog');
        $status->setIsIll(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 60;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_dog_older_than_1_year_with_additions_large_dog()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getpriceAbandonedDogAffiliatedOlderThanOne',
                'getPriceAbandonedDogAffiliatedAdditionNotChipped',
                'getPriceAbandonedDogAffiliatedAdditionNotVaccinated',
                'getPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog',
                'getPriceAbandonedDogAffiliatedAdditionIll'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(5))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(5))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getpriceAbandonedDogAffiliatedOlderThanOne')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionNotChipped')
            ->willReturn(11);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionNotVaccinated')
            ->willReturn(12);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog')
            ->willReturn(13);

        $settings->expects($this->once())
            ->method('getPriceAbandonedDogAffiliatedAdditionIll')
            ->willReturn(14);

        $dog = new Dog();
        $today = new DateTime('today');
        $sixYearsAgo = $today->modify('- 6 year');
        $dog->setDayOfBirth($sixYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsFurTreatment('largedog');
        $status->setIsIll(true);
        $totalActionCosts->setAnimal($dog);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 60;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_cat_younger_than_1_month()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatAffiliatedKitten'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedKitten')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $oneMonthAgo = $today->modify('- 1 month');
        $cat->setDayOfBirth($oneMonthAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_cat_younger_than_3_month()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatAffiliatedYoungerThanThreeMonths'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedYoungerThanThreeMonths')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $threeMonthsAgo = $today->modify('- 3 month');
        $cat->setDayOfBirth($threeMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_cat_older_than_10_years()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatAffiliatedOlderThanTenYears'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedOlderThanTenYears')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $elevenYearsAgo = $today->modify('- 11 years');
        $cat->setDayOfBirth($elevenYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_cat_between_3_months_and_10_years()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears')
            ->willReturn(20);

        $cat = new Cat();
        $today = new DateTime('today');
        $nineYearsAgo = $today->modify('- 9 years');
        $cat->setDayOfBirth($nineYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 20;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_abandoned_affiliation_cat_younger_than_3_month_with_additions()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRepository'])
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->setMethods(['getSettings'])
            ->disableOriginalConstructor()
            ->getMock();

        $settings = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getPriceAbandonedCatAffiliatedYoungerThanThreeMonths',
                'getPriceAbandonedCatAffiliatedAdditionNotChipped',
                'getPriceAbandonedCatAffiliatedAdditionNotVaccinated',
                'getPriceAbandonedCatAffiliatedAdditionNeedsSterilization'
            ])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $em->expects($this->exactly(4))
            ->method('getRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->exactly(4))
            ->method('getSettings')
            ->willReturn($settings);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedYoungerThanThreeMonths')
            ->willReturn(10);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedAdditionNotChipped')
            ->willReturn(20);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedAdditionNotVaccinated')
            ->willReturn(30);

        $settings->expects($this->once())
            ->method('getPriceAbandonedCatAffiliatedAdditionNeedsSterilization')
            ->willReturn(40);

        $cat = new Cat();
        $today = new DateTime('today');
        $threeMonthsAgo = $today->modify('- 3 month');
        $cat->setDayOfBirth($threeMonthsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsSterilization(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('Abandoned');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 100;
        $this->assertEquals($expected, $result);
    }

    public function test_calculate_unknown()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            //->setMethods(['getRepository'])
            ->getMock();

        $totalActionCosts = new TotalActionCosts($em);

        $cat = new Cat();
        $today = new DateTime('today');
        $nineYearsAgo = $today->modify('- 9 years');
        $cat->setDayOfBirth($nineYearsAgo);
        $status = new Abandoned(new AnimalStateMachine());
        $status->setMunicipalityaffiliation(true);
        $totalActionCosts->setAnimal($cat);
        $totalActionCosts->setActionType('yolo');
        $totalActionCosts->setStatus($status);

        $result = $totalActionCosts->getTotalCosts();
        $expected = 999;
        $this->assertEquals($expected, $result);
    }
}
