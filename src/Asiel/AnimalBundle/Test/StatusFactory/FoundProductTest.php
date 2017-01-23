<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Form\StatusType\FoundType;
use Asiel\AnimalBundle\StatusFactory\FoundProduct;

class FoundProductTest extends \PHPUnit_Framework_TestCase
{
    private $foundProduct;

    public function setUp()
    {
        $this->foundProduct = new FoundProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->foundProduct->getEntity();
        $entity = new Found(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->foundProduct->getFormType();
        $form = FoundType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->foundProduct->getType();
        $type = 'Found';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->foundProduct->__toString();
        $type = 'Found';

        $this->assertEquals($toString, $type);
    }
}
