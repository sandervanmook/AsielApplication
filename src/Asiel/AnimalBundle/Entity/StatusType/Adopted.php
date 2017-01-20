<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\CustomerBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Adopted
 *
 * @ORM\Table(name="status_type_adopted")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\AdoptedRepository")
 */
class Adopted extends Status implements AnimalState
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="adoptedPets")
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=10, nullable=true)
     * @Assert\Type(type="int", message="Veld moet een getal zijn")
     */
    private $price;

    private $stateMachine;

    public function __construct(AnimalStateMachine $animalStateMachine)
    {
        $this->stateMachine = $animalStateMachine;
        $this->setOffsiteLocation(true);
        $this->setOnsiteLocation(false);
    }

    /**
     * Statemachine methods
     */
    public function toAbandoned() : bool
    {
        return true;
    }
    public function toAdopted() : bool
    {
        return false;
    }
    public function toDeceased() : bool
    {
        return false;
    }
    public function toFound() : bool
    {
        return true;
    }
    public function toLost() : bool
    {
        return false;
    }
    public function toReturnedOwner() : bool
    {
        return false;
    }
    public function toSeized() : bool
    {
        return true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return parent::getId();
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return 'Adopted';
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Adopted
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     *
     * @return Adopted
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
