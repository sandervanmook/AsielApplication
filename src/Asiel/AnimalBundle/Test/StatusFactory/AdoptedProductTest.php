<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Form\StatusType\AdoptedType;
use Asiel\AnimalBundle\StatusFactory\AdoptedProduct;

class AdoptedProductTest extends \PHPUnit_Framework_TestCase
{
    private $adoptedProduct;

    public function setUp()
    {
        $this->adoptedProduct = new AdoptedProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->adoptedProduct->getEntity();
        $entity = new Adopted(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->adoptedProduct->getFormType();
        $form = AdoptedType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->adoptedProduct->getType();
        $type = 'Adopted';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->adoptedProduct->__toString();
        $type = 'Adopted';

        $this->assertEquals($toString, $type);
    }
}
