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

    /**
     * @var string
     *
     * @ORM\Column(name="municipality", type="string", length=255, nullable=false)
     */
    private $municipality;

    /**
     * @var int
     *
     * @ORM\Column(name="amount_people", type="integer", nullable=false)
     */
    private $amountPeople;

    /**
     * @var int
     *
     * @ORM\Column(name="time_spend", type="integer", nullable=false)
     */
    private $timeSpend;

    /**
     * @var string
     *
     * @ORM\Column(name="medical_actions", type="text", nullable=true)
     */
    private $medicalActions;

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

    /**
     * Set municipality
     *
     * @param string $municipality
     *
     * @return Seized
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;

        return $this;
    }

    /**
     * Get municipality
     *
     * @return string
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * Set amountPeople
     *
     * @param integer $amountPeople
     *
     * @return Seized
     */
    public function setAmountPeople($amountPeople)
    {
        $this->amountPeople = $amountPeople;

        return $this;
    }

    /**
     * Get amountPeople
     *
     * @return integer
     */
    public function getAmountPeople()
    {
        return $this->amountPeople;
    }

    /**
     * Set timeSpend
     *
     * @param integer $timeSpend
     *
     * @return Seized
     */
    public function setTimeSpend($timeSpend)
    {
        $this->timeSpend = $timeSpend;

        return $this;
    }

    /**
     * Get timeSpend
     *
     * @return integer
     */
    public function getTimeSpend()
    {
        return $this->timeSpend;
    }

    /**
     * Set medicalActions
     *
     * @param string $medicalActions
     *
     * @return Seized
     */
    public function setMedicalActions($medicalActions)
    {
        $this->medicalActions = $medicalActions;

        return $this;
    }

    /**
     * Get medicalActions
     *
     * @return string
     */
    public function getMedicalActions()
    {
        return $this->medicalActions;
    }
}
