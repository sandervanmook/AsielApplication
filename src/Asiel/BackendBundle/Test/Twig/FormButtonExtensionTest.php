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

    public function test_output_form_button_with_parameter()
    {
        $buttonValue = 'Bijwerken';
        $extension = new FormButtonExtension();
        $extension->outputFormButton($buttonValue);
        $expected = '<div class="btn-group"><button type="submit" class="btn btn-success">' . $buttonValue . '</button><button type="reset" class="btn btn-back btn-danger">Terug</button></div>';

        $this->expectOutputString($expected);
    }

    public function test_output_form_button_without_parameter()
    {
        $buttonValue = 'Aanmaken';
        $extension = new FormButtonExtension();
        $extension->outputFormButton();
        $expected = '<div class="btn-group"><button type="submit" class="btn btn-success">' . $buttonValue . '</button><button type="reset" class="btn btn-back btn-danger">Terug</button></div>';

        $this->expectOutputString($expected);
    }

    public function test_output_form_button_with_new_parameter()
    {
        $buttonValue = 'Aanmaken';
        $extension = new FormButtonExtension();
        $extension->outputFormButton('Aanmaken', true);
        $expected = '<div class="inline field"><button type="submit" class="positive ui button">'.$buttonValue.'</button><button type="reset" class="btn-back negative ui button">Terug</button></div>';

        $this->expectOutputString($expected);
    }
}
