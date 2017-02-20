<?php


namespace Asiel\Shared\Test\Filter\Animal;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\Shared\Filter\Animal\AnimalFilter;

class AnimalFilterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $filter = new AnimalFilter([], []);
    }

    public function test_type_filter()
    {
        $cat = new Cat();
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_chipnumber_filter()
    {
        $cat = new Cat();
        $cat->setChipnumber(123456789012345);
        $allAnimals = [$cat];
        $searchArray['chipnumber'] = 123456789012345;

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_gender_sub_filter()
    {
        $cat = new Cat();
        $cat->setGender('Male');
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['gender'] = ['Male'];

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_age_sub_filter()
    {
        $cat = new Cat();
        $cat->setDayOfBirth(new \DateTime('now'));

        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['agestart'] = 1;
        $searchArray['ageend'] = 1;

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_status_sub_filter()
    {
        $cat = new Cat();
        $cat->addStatus(new Found(new AnimalStateMachine()));
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['status'] = ['Found'];

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_no_state_status_sub_filter()
    {
        $cat = new Cat();
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['status'] = ['None'];

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_sterilized_true_sub_filter()
    {
        $cat = new Cat();
        $cat->setSterilized(true);
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['sterilized'] = 'true';

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }

    public function test_sterilized_false_sub_filter()
    {
        $cat = new Cat();
        $cat->setSterilized(false);
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['sterilized'] = 'false';

        $filterAnimal = new AnimalFilter($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }
}
