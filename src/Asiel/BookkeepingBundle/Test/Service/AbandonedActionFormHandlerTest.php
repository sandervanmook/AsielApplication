<?php


namespace Asiel\BookkeepingBundle\Test\Service;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\BackendBundle\Entity\BookkeepingSettings;
use Asiel\BackendBundle\Repository\BookkeepingSettingsRepository;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Service\AbandonedActionFormHandler;
use Asiel\BookkeepingBundle\Service\BaseActionFormHandler;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;

class AbandonedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
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
            ->method('getPriceAbandonedPuppy')
            ->willReturn(100);

        $animal = new Dog();
        $animal->setDayOfBirth(new DateTime('yesterday'));

        $this->assertEquals($handler->getTotalActionCosts($animal), 100);
    }

    public function test_create_action()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $animal = new Animal();
        $customer = new Customer();
        $totalCosts = 100;
        $status = new Abandoned(new AnimalStateMachine());

        $action = new Action();
        $action->setDate(new \DateTime('now'));
        $action->setType('Abandoned');
        $action->setTotalCosts($totalCosts);
        $action->setAnimal($animal);
        $action->setFullyPaid(false);
        $action->setCompleted(false);
        $action->setCustomer($customer);
        $action->setStatus($status);

        $result = $handler->createAction($animal, $customer, $totalCosts, $status);
        $this->assertInstanceOf(Action::class, $result);
    }

    public function test_set_net_status()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseActionFormHandler'])
            ->getMock();

        $animal = new Animal();
        $status = new Abandoned(new AnimalStateMachine());
        $customer = new Customer();

        $status->setNeedsChipping(true);
        $status->setNeedsVaccines(true);
        $status->setNeedsSterilization(true);
        $status->setNeedsPassport(true);

        $action = new Action();
        $action->setAnimal($animal);
        $action->setStatus($status);
        $action->setCustomer($customer);

        $handler->setNewStatus($action);
    }
}