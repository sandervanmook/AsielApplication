<?php


namespace Asiel\AnimalBundle\Test\AnimalFactory;


use Asiel\AnimalBundle\AnimalFactory\AnimalType;

class AnimalTypeTest extends \PHPUnit_Framework_TestCase
{
    public function test_cat_type()
    {
        $animalType = new AnimalType('Cat');

        $this->assertEquals($animalType->getValue(), 'Cat');
    }

    public function test_dog_type()
    {
        $animalType = new AnimalType('Dog');

        $this->assertEquals($animalType->getValue(), 'Dog');
    }

    /**
     * @expectedException \Exception
     */
    public function test_it_throws_when_unknown_type()
    {
        $animalType = new AnimalType('Yolo');
    }
}
