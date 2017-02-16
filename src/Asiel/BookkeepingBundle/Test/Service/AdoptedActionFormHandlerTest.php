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
use Asiel\BookkeepingBundle\Service\TotalActionCosts;
use Asiel\Shared\Service\BaseFormHandler;
use DateTime;
use Doctrine\ORM\EntityManager;

class AdoptedActionFormHandlerTest extends \PHPUnit_Framework_TestCase
{
    public $baseActionFormHandler;
    public $bookkeepingSettingsRepository;
    public $bookkeepingSetting;
    public $baseFormHandler;
    public $em;
    public $totalActionCosts;

    public function setUp()
    {
        $this->baseActionFormHandler = $this->getMockBuilder(BaseFormHandler::class)
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
        $baseActionFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new AdoptedActionFormHandler($baseActionFormHandler, $this->totalActionCosts);
        $animal = new Animal();
        $status = new Adopted(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertFalse($handler->stateChangeAllowed($animal));
    }

    public function test_state_change_is_allowed()
    {
        $baseActionFormHandler = $this->getMockBuilder(BaseFormHandler::class)->disableOriginalConstructor()->getMock();
        $handler = new AdoptedActionFormHandler($baseActionFormHandler, $this->totalActionCosts);
        $animal = new Animal();
        $status = new Found(new AnimalStateMachine());
        $animal->addStatus($status);

        $this->assertTrue($handler->stateChangeAllowed($animal));
    }

    public function test_get_animal_repository()
    {
        $adoptedActionFormHandler = $this->getMockBuilder(AdoptedActionFormHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBaseFormHandler'])
            ->getMock();

        $baseFormHandler = $this->getMockBuilder(BaseFormHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $adoptedActionFormHandler->expects($this->once())
            ->method('getBaseFormHandler')
            ->willReturn($baseFormHandler);

        $baseFormHandler->expects($this->once())
            ->method('getAnimalRepository');

        $adoptedActionFormHandler->getAnimalRepository(1);
    }
}
