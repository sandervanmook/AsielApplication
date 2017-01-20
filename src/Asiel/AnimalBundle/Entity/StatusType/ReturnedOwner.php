<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReturnedOwner
 *
 * @ORM\Table(name="status_type_returned_owner")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\ReturnedOwnerRepository")
 */
class ReturnedOwner extends Status implements AnimalState
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
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="ownsAnimals")
     */
    private $owner;

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
        return 'ReturnedOwner';
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return ReturnedOwner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
