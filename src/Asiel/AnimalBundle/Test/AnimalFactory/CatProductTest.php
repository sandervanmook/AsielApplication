<?php

namespace Asiel\AnimalBundle\Test\AnimalFactory;



use Asiel\AnimalBundle\AnimalFactory\CatProduct;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Form\AnimalType\CatType;

class CatProductTest extends \PHPUnit_Framework_TestCase
{
    private $catProduct;

    public function setUp()
    {
        $this->catProduct = new CatProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->catProduct->getEntity();
        $entity = new Cat();

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->catProduct->getFormType();
        $form = CatType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->catProduct->getType();
        $type = 'Cat';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->catProduct->__toString();
        $type = 'Cat';

        $this->assertEquals($toString, $type);
    }
}
