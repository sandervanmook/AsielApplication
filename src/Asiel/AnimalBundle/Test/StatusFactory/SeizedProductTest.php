<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Seized;
use Asiel\AnimalBundle\Form\StatusType\SeizedType;
use Asiel\AnimalBundle\StatusFactory\SeizedProduct;

class SeizedProductTest extends \PHPUnit_Framework_TestCase
{
    private $seizedProduct;

    public function setUp()
    {
        $this->seizedProduct = new SeizedProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->seizedProduct->getEntity();
        $entity = new Seized(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->seizedProduct->getFormType();
        $form = SeizedType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->seizedProduct->getType();
        $type = 'Seized';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->seizedProduct->__toString();
        $type = 'Seized';

        $this->assertEquals($toString, $type);
    }
}
