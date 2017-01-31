<?php


namespace Asiel\LocationBundle\Test\Entity;


use Asiel\LocationBundle\Entity\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        new Location();
    }

    public function test_to_string()
    {
        $location = new Location();
        $location->setName('yolo');

        echo $location;
        $this->expectOutputString('yolo');
    }

}
