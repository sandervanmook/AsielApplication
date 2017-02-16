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
use Asiel\BookkeepingBundle\Service\TotalActionCosts;
use Asiel\CustomerBundle\Entity\Customer;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;
use Doctrine\ORM\EntityManager;

class AbandonedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public $baseActionFormHandler;
    public $bookkeepingSettingsRepository;
    public $bookkeepingSetting;
    public $baseFormHandler;
    public $em;
    public $totalActionCosts;

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

        $this->em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalActionCosts = new TotalActionCosts($this->em);
    }

    public function test_state_change_is_not_allowed()
    {
        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AbandonedActionFormHandler($baseFormHandler, $this->totalActionCosts);
        $animal = new Animal();
        $status = new Abandoned(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertFalse($handler->stateChangeAllowed($animal));
    }

    public function test_state_change_is_allowed()
    {
        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AbandonedActionFormHandler($baseFormHandler, $this->totalActionCosts);
        $animal = new Animal();

        $this->assertTrue($handler->stateChangeAllowed($animal));
    }

    public function test_set_new_status()
    {
        $handler = $this->getMockBuilder(AbandonedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseFormHandler'])
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
