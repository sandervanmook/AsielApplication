<?php

namespace Asiel\AnimalBundle\Entity;

use Asiel\AnimalBundle\Entity\Animal;
use Asiel\BookkeepingBundle\Entity\Action;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Status
 *
 * @ORM\Table(name="status_type")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\StatusRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"status" = "Status",
 *     "Adopted" = "Asiel\AnimalBundle\Entity\StatusType\Adopted",
 *     "Deceased" = "Asiel\AnimalBundle\Entity\StatusType\Deceased",
 *     "Lost" = "Asiel\AnimalBundle\Entity\StatusType\Lost",
 *     "ReturnedOwner" = "Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner",
 *     "Abandoned" = "Asiel\AnimalBundle\Entity\StatusType\Abandoned",
 *     "Found" = "Asiel\AnimalBundle\Entity\StatusType\Found",
 *     "Seized" = "Asiel\AnimalBundle\Entity\StatusType\Seized"
 *     })
 */
class Status
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\AnimalBundle\Entity\Animal", inversedBy="status")
     */
    private $animal;

    /**
     * @var Bool
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * @var Bool
     *
     * @ORM\Column(name="offsite_location", type="boolean")
     */
    private $offsiteLocation;

    /**
     * @var Bool
     *
     * @ORM\Column(name="onsite_location", type="boolean")
     */
    private $onsiteLocation;

    /**
     * @ORM\OneToOne(targetEntity="Asiel\BookkeepingBundle\Entity\Action", mappedBy="status")
     */
    private $action;

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getClassName();
    }

    /**
     * Get registerType
     *
     * @return string
     */
    public function getRegisterType()
    {
        if (isset($this->registerType)) {
            return $this->registerType;
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return 'Status';
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Status
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set animal
     *
     * @param Animal $animal
     *
     * @return Status
     */
    public function setAnimal(Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @return boolean
     */
    public function isArchived()
    {
        return $this->archived;
    }

    /**
     * @param boolean $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * @return boolean
     */
    public function isOffsiteLocation()
    {
        return $this->offsiteLocation;
    }

    /**
     * @param boolean $offsiteLocation
     */
    public function setOffsiteLocation(bool $offsiteLocation)
    {
        $this->offsiteLocation = $offsiteLocation;
    }

    /**
     * @return boolean
     */
    public function isOnsiteLocation()
    {
        return $this->onsiteLocation;
    }

    /**
     * @param boolean $onsiteLocation
     */
    public function setOnsiteLocation(bool $onsiteLocation)
    {
        $this->onsiteLocation = $onsiteLocation;
    }


    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Get offsiteLocation
     *
     * @return boolean
     */
    public function getOffsiteLocation()
    {
        return $this->offsiteLocation;
    }

    /**
     * Get onsiteLocation
     *
     * @return boolean
     */
    public function getOnsiteLocation()
    {
        return $this->onsiteLocation;
    }


    /**
     * Set action
     *
     * @param Action $action
     *
     * @return Status
     */
    public function setAction(Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }
}
