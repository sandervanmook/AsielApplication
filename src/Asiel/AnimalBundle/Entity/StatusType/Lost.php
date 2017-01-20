<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lost
 *
 * @ORM\Table(name="status_type_lost")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\LostRepository")
 */
class Lost extends Status implements AnimalState
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
     * @var string
     *
     * @ORM\Column(name="reason", type="text", nullable=true)
     */
    private $reason;

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
        return false;
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
        return 'Lost';
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Lost
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}

