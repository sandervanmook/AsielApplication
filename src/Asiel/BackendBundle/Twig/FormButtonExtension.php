<?php

namespace Asiel\BackendBundle\Twig;

class FormButtonExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('outputFormButton', array($this, 'outputFormButton')),
        );
    }

    public function outputFormButton($buttonValue = 'Aanmaken')
    {
        // btn-back in the reset button is used by js (global.js) to send the user to the previous page.
        $output = '<div class="inline field output-form-button"><button type="submit" class="btn btn-success">'.$buttonValue.'</button><button type="reset" class="btn-back btn btn-danger">Terug</button></div>';

        echo $output;
    }
}