<?php


namespace Asiel\AnimalBundle\Test\AnimalFactory;


use Asiel\AnimalBundle\AnimalFactory\AnimalFactory;
use Asiel\AnimalBundle\AnimalFactory\AnimalType;

class AnimalFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_start_factory()
    {
        $animalFactory = new AnimalFactory();
        $animalType = new AnimalType('Cat');
        $animalFactory->startFactory($animalType);
    }
}
