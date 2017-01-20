<?php

namespace Asiel\BackendBundle\Twig;

class GenderExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('outputGender', array($this, 'outputGender')),
        );
    }

    public function outputGender($gender)
    {
        switch ($gender) {
            case 'Male':
                $output = '<span class="fa fa-mars" aria-hidden="true"></span>';
                break;
            case 'Female':
                $output = '<span class="fa fa-venus" aria-hidden="true"></span>';
                break;
            case 'Unknown':
                $output = '<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>';
                break;
            default:
                $output = '<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>';
                break;
        }

        echo $output;
    }
}