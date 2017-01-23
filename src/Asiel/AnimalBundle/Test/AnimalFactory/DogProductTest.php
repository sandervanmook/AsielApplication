<?php


namespace Asiel\AnimalBundle\Test\AnimalFactory;


use Asiel\AnimalBundle\AnimalFactory\DogProduct;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Form\AnimalType\DogType;

class DogProductTest extends \PHPUnit_Framework_TestCase
{
    private $dogProduct;

    public function setUp()
    {
        $this->dogProduct = new DogProduct();
    }

    public function test_get_entity()
    {
        $getEntity = $this->dogProduct->getEntity();
        $entity = new Dog();

        $this->assertEquals($getEntity, $entity);
    }

    public function test_get_form_type()
    {
        $getFormType = $this->dogProduct->getFormType();
        $form = DogType::class;

        $this->assertEquals($getFormType, $form);
    }

    public function test_get_type()
    {
        $getType = $this->dogProduct->getType();
        $type = 'Dog';

        $this->assertEquals($getType, $type);
    }

    public function test_to_string()
    {
        $toString = $this->dogProduct->__toString();
        $type = 'Dog';

        $this->assertEquals($toString, $type);
    }
}
