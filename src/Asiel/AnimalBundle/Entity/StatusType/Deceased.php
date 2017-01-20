<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Deceased
 *
 * @ORM\Table(name="status_type_deceased")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\DeceasedRepository")
 */
class Deceased extends Status implements AnimalState
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

    /**
     * @var string
     *
     * @ORM\Column(name="way_deceased", type="string", length=100, nullable=false)
     */
    private $wayDeceased;

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
        return false;
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
        return 'Deceased';
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Deceased
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

    /**
     * @return string
     */
    public function getWayDeceased()
    {
        return $this->wayDeceased;
    }

    /**
     * @param string $wayDeceased
     */
    public function setWayDeceased(string $wayDeceased)
    {
        $this->wayDeceased = $wayDeceased;
    }


}

