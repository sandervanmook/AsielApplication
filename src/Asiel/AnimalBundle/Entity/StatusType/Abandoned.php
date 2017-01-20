<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Abandoned
 *
 * @ORM\Table(name="status_type_abandoned")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\AbandonedRepository")
 */
class Abandoned extends Status implements AnimalState
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
     * @ORM\Column(name="price", type="string", length=10, nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="abandonedAnimals")
     */
    private $abandonedBy;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_vaccines", type="boolean", nullable=true)
     */
    private $needsVaccines;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_chipping", type="boolean", nullable=true)
     */
    private $needsChipping;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_sterilization", type="boolean", nullable=true)
     */
    private $needsSterilization;

    private $stateMachine;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_passport", type="boolean", nullable=true)
     */
    private $needsPassport;

    // Origin TaskEvent options
    const ABANDON_CHIPPED       = [
        'title'         => '(Afstand) Chippen',
        'description'   => 'Het dier is afgestaan en moet nog gechipt worden',
    ];
    const ABANDON_VACCINE       = [
        'title'         => '(Afstand) Vaccinatie',
        'description'   => 'Het dier is afgestaan en moet worden gevaccineerd',
    ];
    const ABANDON_STERILIZE     = [
        'title'         => '(Afstand) Sterilisatie',
        'description'   => 'Het dier is afgestaan en moet worden gecastreerd / gesteriliseerd',
    ];
    const ABANDON_PASSPORT      = [
        'title'         => '(Afstand) Paspoort',
        'description'   => 'Het dier is afgestaan en moet nog een paspoort krijgen',
    ];

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
        return false;
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
        return 'Abandoned';
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Abandoned
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
     * Set price
     *
     * @param string $price
     *
     * @return Abandoned
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
     * Set abandonedBy
     *
     * @param string $abandonedBy
     *
     * @return Abandoned
     */
    public function setAbandonedBy($abandonedBy)
    {
        $this->abandonedBy = $abandonedBy;

        return $this;
    }

    /**
     * Get abandonedBy
     *
     * @return string
     */
    public function getAbandonedBy()
    {
        return $this->abandonedBy;
    }

    /**
     * @return boolean
     */
    public function isNeedsVaccines()
    {
        return $this->needsVaccines;
    }

    /**
     * @param boolean $needsVaccines
     */
    public function setNeedsVaccines(bool $needsVaccines)
    {
        $this->needsVaccines = $needsVaccines;
    }

    /**
     * @return boolean
     */
    public function isNeedsChipping()
    {
        return $this->needsChipping;
    }

    /**
     * @param boolean $needsChipping
     */
    public function setNeedsChipping(bool $needsChipping)
    {
        $this->needsChipping = $needsChipping;
    }

    /**
     * @return boolean
     */
    public function isNeedsSterilization()
    {
        return $this->needsSterilization;
    }

    /**
     * @param boolean $needsSterilization
     */
    public function setNeedsSterilization(bool $needsSterilization)
    {
        $this->needsSterilization = $needsSterilization;
    }

    /**
     * @return boolean
     */
    public function isNeedsPassport()
    {
        return $this->needsPassport;
    }

    /**
     * @param boolean $needsPassport
     */
    public function setNeedsPassport(bool $needsPassport)
    {
        $this->needsPassport = $needsPassport;
    }

}
