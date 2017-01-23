<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;
use Asiel\AnimalBundle\Form\StatusType\ReturnedOwnerType;
use Asiel\AnimalBundle\StatusFactory\ReturnedOwnerProduct;

class ReturnedOwnerProductTest extends \PHPUnit_Framework_TestCase
{
    private $returnedOwnerProduct;

    public function setUp()
    {
        $this->returnedOwnerProduct = new ReturnedOwnerProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->returnedOwnerProduct->getEntity();
        $entity = new ReturnedOwner(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->returnedOwnerProduct->getFormType();
        $form = ReturnedOwnerType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->returnedOwnerProduct->getType();
        $type = 'ReturnedOwner';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->returnedOwnerProduct->__toString();
        $type = 'ReturnedOwner';

        $this->assertEquals($toString, $type);
    }
}
