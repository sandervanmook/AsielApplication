<?php


namespace Asiel\AnimalBundle\Test\Entity;


use Asiel\AnimalBundle\Entity\Picture;

class PictureTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $instance = new Picture();
    }

    public function test_get_public_url()
    {
        $picture = new Picture();
        $picture->setPictureName('yolo');
        $expected = '/pictures/animals/' . $picture->getPictureName();

        $this->assertEquals($picture->getPublicURL(), $expected);
    }
}
