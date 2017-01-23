<?php


namespace Asiel\BackendBundle\Test\EventListener;


use Asiel\BackendBundle\EventListener\UserAlertListener;
use Symfony\Component\HttpFoundation\Session\Session;

class UserAlertListenerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instantiates()
    {
        $listener = new UserAlertListener(new Session());
    }

}
