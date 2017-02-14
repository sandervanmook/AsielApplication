<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Service\AbandonedActionFormHandler;
use Asiel\BookkeepingBundle\Service\BaseActionFormHandler;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;

class AbandonedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_state_change_is_not_allowed()
    {
        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AbandonedActionFormHandler($baseActionFormHandler);
        $animal = new Animal();
        $status = new Abandoned(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertFalse($handler->stateChangeAllowed($animal));
    }

    public function test_state_change_is_allowed()
    {
        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AbandonedActionFormHandler($baseActionFormHandler);
        $animal = new Animal();

        $this->assertTrue($handler->stateChangeAllowed($animal));
    }

    public function test_get_total_action_costs_kitten()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($baseActionFormHandler);

        $baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($bookkeepingSetting);

        $bookkeepingSetting->expects($this->once())
            ->method('getPriceAbandonedKitten')
            ->willReturn(100);

        $animal = new Cat();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_cat()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($baseActionFormHandler);

        $baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($bookkeepingSetting);

        $bookkeepingSetting->expects($this->once())
            ->method('getPriceAbandonedCat')
            ->willReturn(100);

        $animal = new Cat();
        $now = new \DateTime();
        $twoYearsAgo = $now->modify('-3 year');
        $animal->setDayOfBirth($twoYearsAgo);

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_dog()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($baseActionFormHandler);

        $baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($bookkeepingSetting);

        $bookkeepingSetting->expects($this->once())
            ->method('getPriceAbandonedDog')
            ->willReturn(100);

        $animal = new Dog();
        $now = new \DateTime();
        $twoYearsAgo = $now->modify('-3 year');
        $animal->setDayOfBirth($twoYearsAgo);

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_puppy()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($baseActionFormHandler);

        $baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($bookkeepingSetting);

        $bookkeepingSetting->expects($this->once())
            ->method('getPriceAbandonedPuppy')
            ->willReturn(100);

        $animal = new Dog();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test()
    {
        $this->markTestIncomplete('herhaling in de setup zetten');
    }
}
