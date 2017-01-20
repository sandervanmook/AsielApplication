<?php

namespace Asiel\BackendBundle\Twig;

class BooleanExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('outputBool', array($this, 'outputBool')),
        );
    }

    public function outputBool($value)
    {
        if ($value) {
            $output = '<span class="fa fa-check" aria-hidden="true"></span>';
        } else {
            $output = '<span class="fa fa-times" aria-hidden="true"></span>';
        }

        echo $output;
    }
}
