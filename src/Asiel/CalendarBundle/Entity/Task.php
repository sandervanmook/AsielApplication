<?php

namespace Asiel\CalendarBundle\Entity;

use Asiel\AnimalBundle\Entity\Animal;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="Asiel\CalendarBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="date_created", type="date")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_due", type="date")
     * @Assert\NotBlank()
     */
    private $dateDue;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_complete", type="boolean", nullable=true)
     */
    private $isComplete;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\AnimalBundle\Entity\Animal", inversedBy="tasks")
     */
    private $animal;

    /**
     * @var string
     *
     * @ORM\Column(name="start", type="string", length=255)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255)
     */
    private $createdBy;

    // DateDue TaskEvent options
    const TODAY     = 'PT1S';
    const TOMORROW  = 'P1D';
    const THREEDAYS = 'P3D';
    const FIVEDAYS  = 'P5D';
    const WEEK      = 'P1W';
    const FIFTEENDAYS = 'P15D';

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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Task
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateDue
     *
     * @param \DateTime $dateDue
     *
     * @return Task
     */
    public function setDateDue($dateDue)
    {
        $this->dateDue = $dateDue;
        $this->start = $dateDue->format('Y-m-d');

        return $this;
    }

    /**
     * Get dateDue
     *
     * @return \DateTime
     */
    public function getDateDue()
    {
        return $this->dateDue;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isComplete
     *
     * @param boolean $isComplete
     *
     * @return Task
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = $isComplete;

        return $this;
    }

    /**
     * Get isComplete
     *
     * @return bool
     */
    public function getIsComplete()
    {
        return $this->isComplete;
    }

    /**
     * Set animal
     *
     * @param Animal $animal
     *
     * @return Task
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
     * @return bool
     */
    public function isOverDue()
    {
        if ($this->isComplete == false) {
            if ($this->dateDue < new DateTime('today')) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy(string $createdBy)
    {
        $this->createdBy = $createdBy;
    }



}
