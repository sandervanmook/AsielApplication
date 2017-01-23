<?php


namespace Asiel\BackendBundle\Test\Twig;


use Asiel\BackendBundle\Twig\BooleanExtension;

class BooleanExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_functions()
    {
        $extension = new BooleanExtension();
        $result = $extension->getFunctions();

        $expected = [new \Twig_SimpleFunction('outputBool', [$extension, 'outputBool'])];

        $this->assertEquals($result, $expected);
    }

    public function test_output_bool_true()
    {
        $value = true;
        $extension = new BooleanExtension();

        $extension->outputBool($value);
        $expected = '<span class="fa fa-check" aria-hidden="true"></span>';

        $this->expectOutputString($expected);
    }

    public function test_output_bool_false()
    {
        $value = false;
        $extension = new BooleanExtension();

        $extension->outputBool($value);
        $expected = '<span class="fa fa-times" aria-hidden="true"></span>';

        $this->expectOutputString($expected);
    }
}
