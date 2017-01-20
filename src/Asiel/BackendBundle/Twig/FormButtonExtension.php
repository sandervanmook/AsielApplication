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
        $output = '<div class="btn-group"><button type="submit" class="btn btn-success">'.$buttonValue.'</button><button type="reset" class="btn btn-back btn-danger">Terug</button></div>';

        echo $output;
    }
}