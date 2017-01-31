<?php


namespace Asiel\FrontendBundle\Test\SearchAnimal;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\FrontendBundle\SearchAnimal\FilterAnimal;

class FilterAnimalTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        new FilterAnimal([],[]);
    }

    public function test_type_filter()
    {
        $dog = new Dog();
        $allAnimals = [$dog];
        $searchArray['type'] = ['Dog'];

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$dog]);
    }

    public function test_gender_sub_filter()
    {
        $dog = new Dog();
        $dog->setGender('Unknown');
        $allAnimals = [$dog];
        $searchArray['type'] = ['Dog'];
        $searchArray['gender'] = ['Unknown'];

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$dog]);
    }

    public function test_age_sub_filter()
    {
        $dog = new Dog();
        $dog->setDayOfBirth(new \DateTime('now'));
        $dog->setAge();
        $allAnimals = [$dog];
        $searchArray['type'] = ['Dog'];
        $searchArray['agestart'] = 1;
        $searchArray['ageend'] = 1;

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$dog]);
    }

    public function test_status_sub_filter()
    {
        $cat = new Cat();
        $cat->addStatus(new Found(new AnimalStateMachine()));
        $allAnimals = [$cat];
        $searchArray['type'] = ['Cat'];
        $searchArray['status'] = ['Found'];

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
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

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
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

        $filterAnimal = new FilterAnimal($allAnimals, $searchArray);
        $filterAnimal->filter();
        $result = $filterAnimal->getFilterResult();

        $this->assertEquals($result, [$cat]);
    }
}
