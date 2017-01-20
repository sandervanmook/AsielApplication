<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Seized
 *
 * @ORM\Table(name="status_type_seized")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\SeizedRepository")
 */
class Seized extends Status implements AnimalState
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $stateMachine;

    public function __construct(AnimalStateMachine $animalStateMachine)
    {
        $this->stateMachine = $animalStateMachine;
        $this->setOffsiteLocation(false);
        $this->setOnsiteLocation(true);
    }

    /**
     * Statemachine methods
     */
    public function toAbandoned() : bool
    {
        return false;
    }
    public function toAdopted() : bool
    {
        return true;
    }
    public function toDeceased() : bool
    {
        return true;
    }
    public function toFound() : bool
    {
        return false;
    }
    public function toLost() : bool
    {
        return true;
    }
    public function toReturnedOwner() : bool
    {
        return true;
    }
    public function toSeized() : bool
    {
        return false;
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
        return 'Seized';
    }
}

