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
}
