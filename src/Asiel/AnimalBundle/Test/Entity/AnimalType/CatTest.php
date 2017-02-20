<?php


namespace Asiel\AnimalBundle\Test\Entity\AnimalType;


use Asiel\AnimalBundle\Entity\AnimalType\Cat;

class CatTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_class_name()
    {
        $cat = new Cat();

        $this->assertEquals($cat->getClassName(), 'Cat');
    }

    public function test_is_currently_a_kitten()
    {
        $cat = new Cat();
        $cat->setDayOfBirth(new \DateTime('today'));

        $this->assertTrue($cat->isCurrentlyAKitten());
    }

    public function test_is_currently_not_a_kitten()
    {
        $cat = new Cat();
        $now = new \DateTime('today');
        $twoYearsAgo = $now->modify('-2 year');
        $cat->setDayOfBirth($twoYearsAgo);

        $this->assertFalse($cat->isCurrentlyAKitten());
    }

    public function test_is_currently_a_cat()
    {
        $cat = new Cat();
        $now = new \DateTime('today');
        $twoYearsAgo = $now->modify('-2 year');

        $cat->setDayOfBirth($twoYearsAgo);

        $this->assertTrue($cat->isCurrentlyACat());
    }

    public function test_is_currently_not_a_cat()
    {
        $cat = new Cat();

        $cat->setDayOfBirth(new \DateTime('yesterday'));

        $this->assertFalse($cat->isCurrentlyACat());
    }
}
