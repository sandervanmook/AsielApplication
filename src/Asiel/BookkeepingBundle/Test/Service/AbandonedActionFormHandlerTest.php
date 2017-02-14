<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Service\AbandonedActionFormHandler;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;

class AbandonedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public $baseFormHandler;

    public function setUp()
    {
        $this->baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @group sander
     */
    public function test_state_change_is_not_allowed()
    {
        $handler = new AbandonedActionFormHandler($this->baseFormHandler);
        $animal = new Animal();
        $status = new Adopted(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertFalse($handler->stateChangeAllowed($animal));
    }

    /**
     * @group sander
     */
    public function test_state_change_is_allowed()
    {
        $handler = new AbandonedActionFormHandler($this->baseFormHandler);
        $animal = new Animal();

        $this->assertTrue($handler->stateChangeAllowed($animal));
    }

    /**
     * @group sander
     */
    public function test_get_total_action_costs_kitten()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSettingsRepository = $this->getMockBuilder(BookkeepingSettingsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookkeepingSetting = $this->getMockBuilder(BookkeepingSettings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $animal = new Cat();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $handler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($bookkeepingSettingsRepository);

        $bookkeepingSettingsRepository->expects($this->once())
            ->method('getSettings')
            ->willReturn($bookkeepingSetting);

        $bookkeepingSetting->expects($this->once())
            ->method('getPriceAbandonedKitten')
            ->willReturn(100);

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }
}
