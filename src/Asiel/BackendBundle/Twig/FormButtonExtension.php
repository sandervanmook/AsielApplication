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
        $output = '<div class="inline field"><button type="submit" class="positive ui button">'.$buttonValue.'</button><button type="reset" class="btn-back negative ui button">Terug</button></div>';

        echo $output;
    }
}