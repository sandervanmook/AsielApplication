<?php


namespace Asiel\BackendBundle\Test\Twig;


use Asiel\BackendBundle\Twig\FormButtonExtension;

class FormButtonExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_functions()
    {
        $extension = new FormButtonExtension();
        $result = $extension->getFunctions();

        $expected = [new \Twig_SimpleFunction('outputFormButton', [$extension, 'outputFormButton'])];

        $this->assertEquals($result, $expected);
    }

    public function test_output_form_button()
    {
        $buttonValue = 'Bijwerken';
        $extension = new FormButtonExtension();
        $extension->outputFormButton($buttonValue);
        $expected = '<div class="inline field output-form-button"><button type="submit" class="btn btn-success">Bijwerken</button><button type="reset" class="btn-back btn btn-danger">Terug</button></div>';

        $this->expectOutputString($expected);
    }
}
