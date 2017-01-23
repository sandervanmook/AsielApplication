<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Form\StatusType\AbandonedType;
use Asiel\AnimalBundle\StatusFactory\AbandonedProduct;

class AbandonedProductTest extends \PHPUnit_Framework_TestCase
{
    private $abandonedProduct;

    public function setUp()
    {
        $this->abandonedProduct = new AbandonedProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->abandonedProduct->getEntity();
        $entity = new Abandoned(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->abandonedProduct->getFormType();
        $form = AbandonedType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->abandonedProduct->getType();
        $type = 'Abandoned';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->abandonedProduct->__toString();
        $type = 'Abandoned';

        $this->assertEquals($toString, $type);
    }

}
