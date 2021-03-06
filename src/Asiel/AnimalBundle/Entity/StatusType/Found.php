<?php

namespace Asiel\AnimalBundle\Entity\StatusType;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalState;
use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\Status;
use Asiel\CustomerBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Found
 *
 * @ORM\Table(name="status_type_found")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusType\FoundRepository")
 */
class Found extends Status implements AnimalState
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
     * @ORM\Column(name="found_at_location", type="text", nullable=true)
     */
    private $foundAtLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="animal_state", type="text", nullable=true)
     */
    private $animalState;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\CustomerBundle\Entity\Customer", inversedBy="foundAnimals")
     */
    private $foundBy;

    /**
     * @var string
     *
     * @ORM\Column(name="found_type", type="string", length=255, nullable=true)
     */
    private $foundType;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_chipping", type="boolean", nullable=true)
     */
    private $needsChipping;

    /**
     * @var string
     *
     * @ORM\Column(name="found_municipality", type="string", length=255, nullable=false)
     */
    private $foundMunicipality;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_vaccines", type="boolean", nullable=true)
     */
    private $needsVaccines;

    /**
     * @var bool
     *
     * @ORM\Column(name="extra_costs_applied", type="boolean", nullable=true)
     */
    private $extraCostsApplied;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_de_worm", type="boolean", nullable=true)
     */
    private $needsDeWorm;

    private $stateMachine;

    // Origin TaskEvent options
    const FOUND_CHIPPED         = [
        'title'         => '(Gevonden) Chippen',
        'description'   => 'Het dier is gevonden en moet nog gechipt worden',
    ];
    const FOUND_CHECKUP         = [
        'title'         => '(Gevonden) Checkup',
        'description'   => 'Het dier is 3 dagen in het asiel, het moet gevaccineerd, ontwormd en ontvlooid worden',
    ];
    const FOUND_AVAILABLE       = [
        'title'         => '(Gevonden) Beschikbaar',
        'description'   => 'Het dier is 15 dagen in het asiel, het mag ter adoptie worden aangeboden. Zet het eventueel zichtbaar voor publiek.',
    ];
    const FOUND_DEWORM       = [
        'title'         => '(Gevonden) Ontwormen',
        'description'   => 'Het dier is gevonden en moet ontwormt worden.',
    ];
    const FOUND_VACCINATE       = [
        'title'         => '(Gevonden) Vaccinatie',
        'description'   => 'Het dier is gevonden en moet gevaccineerd worden.',
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
        return true;
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
        return 'Found';
    }

    /**
     * Set fountAtLocation
     *
     * @param string $foundAtLocation
     *
     * @return Found
     */
    public function setFoundAtLocation($foundAtLocation)
    {
        $this->foundAtLocation = $foundAtLocation;

        return $this;
    }

    /**
     * Get foundAtLocation
     *
     * @return string
     */
    public function getFoundAtLocation()
    {
        return $this->foundAtLocation;
    }

    /**
     * Set animalState
     *
     * @param string $animalState
     *
     * @return Found
     */
    public function setAnimalState($animalState)
    {
        $this->animalState = $animalState;

        return $this;
    }

    /**
     * Get animalState
     *
     * @return string
     */
    public function getAnimalState()
    {
        return $this->animalState;
    }

    /**
     * Set foundType
     *
     * @param string $foundType
     *
     * @return Found
     */
    public function setFoundType($foundType)
    {
        $this->foundType = $foundType;

        return $this;
    }

    /**
     * Get foundType
     *
     * @return string
     */
    public function getFoundType()
    {
        return $this->foundType;
    }

    /**
     * Set foundBy
     *
     * @param Customer $foundBy
     *
     * @return Found
     */
    public function setFoundBy(Customer $foundBy = null)
    {
        $this->foundBy = $foundBy;

        return $this;
    }

    /**
     * Get foundBy
     *
     * @return Customer
     */
    public function getFoundBy()
    {
        return $this->foundBy;
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
     * Set foundMunicipality
     *
     * @param string $foundMunicipality
     *
     * @return Found
     */
    public function setFoundMunicipality($foundMunicipality)
    {
        $this->foundMunicipality = $foundMunicipality;

        return $this;
    }

    /**
     * Get foundMunicipality
     *
     * @return string
     */
    public function getFoundMunicipality()
    {
        return $this->foundMunicipality;
    }

    /**
     * Set needsVaccines
     *
     * @param boolean $needsVaccines
     *
     * @return Found
     */
    public function setNeedsVaccines($needsVaccines)
    {
        $this->needsVaccines = $needsVaccines;

        return $this;
    }

    /**
     * Get needsVaccines
     *
     * @return boolean
     */
    public function needsVaccines()
    {
        return $this->needsVaccines;
    }

    /**
     * Set needsDeWorm
     *
     * @param boolean $needsDeWorm
     *
     * @return Found
     */
    public function setNeedsDeWorm($needsDeWorm)
    {
        $this->needsDeWorm = $needsDeWorm;

        return $this;
    }

    /**
     * Get needsDeWorm
     *
     * @return boolean
     */
    public function needsDeWorm()
    {
        return $this->needsDeWorm;
    }

    /**
     * Get needsChipping
     *
     * @return boolean
     */
    public function getNeedsChipping()
    {
        return $this->needsChipping;
    }

    /**
     * Get needsVaccines
     *
     * @return boolean
     */
    public function getNeedsVaccines()
    {
        return $this->needsVaccines;
    }

    /**
     * Set extraCostsApplied
     *
     * @param boolean $extraCostsApplied
     *
     * @return Found
     */
    public function setExtraCostsApplied($extraCostsApplied)
    {
        $this->extraCostsApplied = $extraCostsApplied;

        return $this;
    }

    /**
     * Get extraCostsApplied
     *
     * @return boolean
     */
    public function isExtraCostsApplied()
    {
        return $this->extraCostsApplied;
    }

    /**
     * Get needsDeWorm
     *
     * @return boolean
     */
    public function getNeedsDeWorm()
    {
        return $this->needsDeWorm;
    }
}
