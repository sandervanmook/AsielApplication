<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Lost;
use Asiel\AnimalBundle\Form\StatusType\LostType;
use Asiel\AnimalBundle\StatusFactory\LostProduct;

class LostProductTest extends \PHPUnit_Framework_TestCase
{
    private $lostProduct;

    public function setUp()
    {
        $this->lostProduct = new LostProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->lostProduct->getEntity();
        $entity = new Lost(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->lostProduct->getFormType();
        $form = LostType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->lostProduct->getType();
        $type = 'Lost';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->lostProduct->__toString();
        $type = 'Lost';

        $this->assertEquals($toString, $type);
    }
}
