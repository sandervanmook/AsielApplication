<?php


namespace Asiel\AnimalBundle\Test\Entity;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Animal;
use Asiel\AnimalBundle\Entity\Incident;
use Asiel\AnimalBundle\Entity\Medical;
use Asiel\AnimalBundle\Entity\StatusType\Lost;
use Asiel\AnimalBundle\Entity\StatusType\NoState;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CalendarBundle\Entity\Task;
use Doctrine\Common\Collections\ArrayCollection;


class AnimalTest extends \PHPUnit_Framework_TestCase
{
    private $animal;

    public function setUp()
    {
        $this->animal = new Animal();
    }

    public function test_it_instantiates()
    {
        $animal = new Animal();
    }

    public function test_to_string()
    {
        $this->animal->setName('yolo');

        $this->assertEquals($this->animal->__toString(), 'yolo');
    }

    public function test_get_id()
    {
        $this->assertEquals($this->animal->getId(), null);
    }

    public function test_get_name()
    {
        $this->animal->setName('yolo');

        $this->assertEquals($this->animal->getName(), 'yolo');
    }

    public function test_set_medical_entry()
    {
        $this->animal->setMedicalEntry(new Medical());

        $this->assertEquals($this->animal->getMedicalEntry(), new Medical());
    }

    public function test_set_incidents()
    {
        $this->animal->setIncidents(new Incident());

        $this->assertEquals($this->animal->getIncidents(), new Incident());
    }

    public function test_set_chipnumber()
    {
        $this->animal->setChipnumber(1);

        $this->assertEquals($this->animal->getChipnumber(), 1);
    }

    // Skipped rest of getters and setters

    public function test_check_no_status_true()
    {
        $animal = new Animal();
        $this->assertTrue($animal->checkNoStatus());
    }

    public function test_check_no_status_false()
    {
        $animal = new Animal();
        $animal->addStatus(new Lost(new AnimalStateMachine()));
        $this->assertFalse($animal->checkNoStatus());
    }

    public function test_set_age()
    {
        $this->animal->setDayOfBirth(new \DateTime('1-1-2000'));
        $this->assertEquals($this->animal->getAge(), 17);

    }

    public function test_open_tasks_with_no_open_tasks()
    {
        $collection = new ArrayCollection();
        $result = $this->animal->openTasks($collection);
        $this->assertNull($result);
    }

    public function test_open_tasks_with_open_tasks()
    {
        $collection = new ArrayCollection();
        $task = new Task();
        $collection->add($task);
        $task->setIsComplete(false);
        $result = $this->animal->openTasks($collection);
        $this->assertTrue($result);
    }

    public function test_get_active_state_with_active_state()
    {
        $status = new Lost(new AnimalStateMachine());
        $status->isArchived(false);
        $this->animal->addStatus($status);

        $this->assertEquals($this->animal->getActiveState(), $status);
    }

    public function test_get_active_state_without_active_state()
    {
        $nostate = new NoState(new AnimalStateMachine());
        $animal = new Animal();
        $status = new Lost(new AnimalStateMachine());
        $status->isArchived(true);
        $animal->addStatus($status);

        $this->assertEquals($this->animal->getActiveState(), $nostate);
    }
}
