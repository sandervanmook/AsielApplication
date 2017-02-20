<?php


namespace Asiel\AnimalBundle\Test\Entity\AnimalType;


use Asiel\AnimalBundle\Entity\AnimalType\Dog;

class DogTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_class_name()
    {
        $cat = new Dog();

        $this->assertEquals($cat->getClassName(), 'Dog');
    }

    public function test_is_currently_a_puppy()
    {
        $dog = new Dog();
        $dog->setDayOfBirth(new \DateTime('today'));

        $this->assertTrue($dog->isCurrentlyAPuppy());
    }

    public function test_is_currently_not_a_puppy()
    {
        $dog = new Dog();
        $now = new \DateTime('today');
        $twoYearsAgo = $now->modify('-2 year');
        $dog->setDayOfBirth($twoYearsAgo);

        $this->assertFalse($dog->isCurrentlyApuppy());
    }

    public function test_is_currently_a_dog()
    {
        $dog = new Dog();
        $now = new \DateTime('today');
        $twoYearsAgo = $now->modify('-2 year');

        $dog->setDayOfBirth($twoYearsAgo);

        $this->assertTrue($dog->isCurrentlyADog());
    }

    public function test_is_currently_not_a_dog()
    {
        $dog = new Dog();

        $dog->setDayOfBirth(new \DateTime('yesterday'));

        $this->assertFalse($dog->isCurrentlyADog());
    }
}
