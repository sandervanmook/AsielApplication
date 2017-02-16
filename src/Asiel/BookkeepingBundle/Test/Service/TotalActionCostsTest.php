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

}
