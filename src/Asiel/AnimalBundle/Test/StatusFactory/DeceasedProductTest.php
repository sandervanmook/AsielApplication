<?php


namespace Asiel\AnimalBundle\Test\StatusFactory;


use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\StatusType\Deceased;
use Asiel\AnimalBundle\Form\StatusType\DeceasedType;
use Asiel\AnimalBundle\StatusFactory\DeceasedProduct;

class DeceasedProductTest extends \PHPUnit_Framework_TestCase
{
    private $deceasedProduct;

    public function setUp()
    {
        $this->deceasedProduct = new DeceasedProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->deceasedProduct->getEntity();
        $entity = new Deceased(new AnimalStateMachine());

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->deceasedProduct->getFormType();
        $form = DeceasedType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->deceasedProduct->getType();
        $type = 'Deceased';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->deceasedProduct->__toString();
        $type = 'Deceased';

        $this->assertEquals($toString, $type);
    }
}
