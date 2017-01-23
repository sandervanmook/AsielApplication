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
}
