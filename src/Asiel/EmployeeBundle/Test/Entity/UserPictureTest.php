<?php


namespace Asiel\EmployeeBundle\Test\Entity;


use Asiel\EmployeeBundle\Entity\UserPicture;

class UserPictureTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $instance = new UserPicture();
    }

    public function test_get_public_url()
    {
        $picture = new UserPicture();
        $picture->setPictureName('yolo');
        $expected = '/pictures/users/' . $picture->getPictureName();

        $this->assertEquals($picture->getPublicURL(), $expected);
    }

}
