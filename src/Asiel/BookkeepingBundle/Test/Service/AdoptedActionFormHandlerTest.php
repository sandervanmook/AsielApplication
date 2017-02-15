<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Service\AdoptedActionFormHandler;
use Asiel\BookkeepingBundle\Service\BaseActionFormHandler;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;

class AdoptedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public $baseActionFormHandler;
    public $bookkeepingSettingsRepository;
    public $bookkeepingSetting;
    public $baseFormHandler;

    public function setUp()
    {
        $this->baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function test_state_change_is_not_allowed()
    {
        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new AdoptedActionFormHandler($baseActionFormHandler);
        $animal = new Animal();
        $status = new Adopted(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertFalse($handler->stateChangeAllowed($animal));
    }

    public function test_state_change_is_allowed()
    {
        $baseActionFormHandler = $this->getMockBuilder(BaseActionFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AdoptedActionFormHandler($baseActionFormHandler);
        $animal = new Animal();
        $status = new Found(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertTrue($handler->stateChangeAllowed($animal));
    }

    public function test_get_total_action_costs_kitten()
    {
        $handler = $this->getMockBuilder(AdoptedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($this->baseActionFormHandler);

        $this->baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($this->baseFormHandler);

        $this->baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($this->bookkeepingSettingsRepository);

        $this->bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($this->bookkeepingSetting);

        $this->bookkeepingSetting->expects($this->once())
            ->method('getPriceAdoptedKitten')
            ->willReturn(100);

        $animal = new Cat();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_cat()
    {
        $handler = $this->getMockBuilder(AdoptedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($this->baseActionFormHandler);

        $this->baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($this->baseFormHandler);

        $this->baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($this->bookkeepingSettingsRepository);

        $this->bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($this->bookkeepingSetting);

        $this->bookkeepingSetting->expects($this->once())
            ->method('getPriceAdoptedCat')
            ->willReturn(100);

        $animal = new Cat();
        $now = new \DateTime();
        $twoYearsAgo = $now->modify('-3 year');
        $animal->setDayOfBirth($twoYearsAgo);

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_dog()
    {
        $handler = $this->getMockBuilder(AdoptedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($this->baseActionFormHandler);

        $this->baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($this->baseFormHandler);

        $this->baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($this->bookkeepingSettingsRepository);

        $this->bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($this->bookkeepingSetting);

        $this->bookkeepingSetting->expects($this->once())
            ->method('getPriceAdoptedDog')
            ->willReturn(100);

        $animal = new Dog();
        $now = new \DateTime();
        $twoYearsAgo = $now->modify('-3 year');
        $animal->setDayOfBirth($twoYearsAgo);

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_get_total_action_costs_puppy()
    {
        $handler = $this->getMockBuilder(AdoptedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $handler->expects($this->once())
            ->method('getBaseActionFormHandler')
            ->willReturn($this->baseActionFormHandler);

        $this->baseActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($this->baseFormHandler);

        $this->baseFormHandler->expects($this->once())
            ->method('getBookkeepingSettingsRepository')
            ->willReturn($this->bookkeepingSettingsRepository);

        $this->bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($this->bookkeepingSetting);

        $this->bookkeepingSetting->expects($this->once())
            ->method('getPriceAdoptedPuppy')
            ->willReturn(100);

        $animal = new Dog();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }
}
