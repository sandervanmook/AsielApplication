<?php


namespace Asiel\BackendBundle\Test\Twig;


use Asiel\BackendBundle\Twig\GenderExtension;

class GenderExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_functions()
    {
        $extension = new GenderExtension();
        $result = $extension->getFunctions();

        $expected = [new \Twig_SimpleFunction('outputGender', [$extension, 'outputGender'])];

        $this->assertEquals($result, $expected);
    }

    public function test_output_gender_male()
    {
        $extension = new GenderExtension();
        $gender = 'Male';
        $extension->outputGender($gender);
        $expection = '<span class="fa fa-mars" aria-hidden="true"></span>';

        $this->expectOutputString($expection);
    }

    public function test_output_gender_female()
    {
        $extension = new GenderExtension();
        $gender = 'Female';
        $extension->outputGender($gender);
        $expection = '<span class="fa fa-venus" aria-hidden="true"></span>';

        $this->expectOutputString($expection);
    }

    public function test_output_gender_unknown()
    {
        $extension = new GenderExtension();
        $gender = 'Unknown';
        $extension->outputGender($gender);
        $expection = '<i class="help icon"></i>';

        $this->expectOutputString($expection);
    }

    public function test_output_gender_no_invalid_parameter()
    {
        $extension = new GenderExtension();
        $gender = 'Yolo';
        $extension->outputGender($gender);
        $expection = '<i class="help icon"></i>';

        $this->expectOutputString($expection);
    }
}
