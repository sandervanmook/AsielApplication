<?php

namespace Asiel\AnimalBundle\Entity;

use Asiel\AnimalBundle\AnimalStateMachine\AnimalStateMachine;
use Asiel\AnimalBundle\Entity\AnimalType\Cat;
use Asiel\AnimalBundle\Entity\AnimalType\Dog;
use Asiel\AnimalBundle\Entity\StatusType\NoState;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\CalendarBundle\Entity\Task;
use Asiel\CustomerBundle\Entity\Customer;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Animal
 *
 * @ORM\Table(name="animal")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\AnimalRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"animal" = "Animal", "Cat" = "Asiel\AnimalBundle\Entity\AnimalType\Cat","Dog" = "Asiel\AnimalBundle\Entity\AnimalType\Dog"})
 * @UniqueEntity("chipnumber")
 */
class Animal
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\Status", mappedBy="animal")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\LocationBundle\Entity\Location")
     */
    private $dayLocation;

    /**
     * @ORM\ManyToOne(targetEntity="Asiel\LocationBundle\Entity\Location")
     */
    private $nightLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="medical_entry", type="string", length=255, nullable=true)
     */
    private $medicalEntry;

    /**
     * @var string
     *
     * @ORM\Column(name="incidents", type="string", length=255, nullable=true)
     */
    private $incidents;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="register_date", type="date", nullable=false)
     * @Assert\NotBlank()
     */
    private $registerDate;

    /**
     * @ORM\Column(name="chipnumber", type="string", length=15, nullable=true)
     * @Assert\Length(
     *     min= 15,
     *     max= 15,
     * )
     */
    private $chipnumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="not_chipped", type="boolean")
     */
    private $notChipped;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_number", type="string", length=25, nullable=true)
     */
    private $passportNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day_of_birth", type="date", nullable=false)
     * @Assert\LessThan("today", message = "Datum moet in het verleden zijn")
     * @Assert\NotBlank()
     */
    private $dayOfBirth;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="admission_date", type="date", nullable=false)
     * @Assert\NotBlank()
     */
    private $admissionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Maak een keuze")
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\Picture", mappedBy="animal")
     */
    private $pictures;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $colour;

    /**
     * @var string
     *
     * @ORM\Column(name="characteristics", type="text", nullable=true)
     */
    private $characteristics;

    /**
     * @var string
     *
     * @ORM\Column(name="medical_problems", type="text", nullable=true)
     */
    private $medicalProblems;

    /**
     * @var bool
     *
     * @ORM\Column(name="compatible_children_below_10y", type="boolean")
     */
    private $compatibleChildrenBelow10y;

    /**
     * @var bool
     *
     * @ORM\Column(name="compatible_children_above_10y", type="boolean")
     */
    private $compatibleChildrenAbove10y;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="outside_animal", type="string", length=20, nullable=false)
     * * @Assert\NotBlank(message="Maak een keuze")
     */
    private $outsideAnimal;

    /**
     * @var string
     *
     * @ORM\Column(name="known_aggression", type="text", nullable=true)
     */
    private $knownAggression;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible_public", type="boolean")
     */
    private $visiblePublic;

    /**
     * @var
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var bool
     *
     * @ORM\Column(name="escapes_alot", type="boolean")
     */
    private $escapesAlot;

    /**
     * @var bool
     *
     * @ORM\Column(name="compatible_old_people", type="boolean")
     */
    private $compatibleOldPeople;

    /**
     * @var bool
     *
     * @ORM\Column(name="compatible_children_above_7y", type="boolean")
     */
    private $compatibleChildrenAbove7y;

    /**
     * @var bool
     *
     * @ORM\Column(name="compatible_children_below_7y", type="boolean")
     */
    private $compatibleChildrenBelow7y;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="text", nullable=true)
     */
    private $facebookId;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\CalendarBundle\Entity\Task", mappedBy="animal")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Action", mappedBy="animal")
     */
    private $actions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->status = new ArrayCollection();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set medicalEntry
     *
     * @param string $medicalEntry
     *
     * @return Animal
     */
    public function setMedicalEntry($medicalEntry)
    {
        $this->medicalEntry = $medicalEntry;

        return $this;
    }

    /**
     * Get medicalEntry
     *
     * @return string
     */
    public function getMedicalEntry()
    {
        return $this->medicalEntry;
    }

    /**
     * Set incidents
     *
     * @param string $incidents
     *
     * @return Animal
     */
    public function setIncidents($incidents)
    {
        $this->incidents = $incidents;

        return $this;
    }

    /**
     * Get incidents
     *
     * @return string
     */
    public function getIncidents()
    {
        return $this->incidents;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     *
     * @return Animal
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set chipnumber
     *
     * @param string $chipnumber
     *
     * @return Animal
     */
    public function setChipnumber($chipnumber)
    {
        $this->chipnumber = $chipnumber;

        return $this;
    }

    /**
     * Get chipnumber
     *
     * @return string
     */
    public function getChipnumber()
    {
        return $this->chipnumber;
    }

    /**
     * Set dayOfBirth
     *
     * @param \DateTime $dayOfBirth
     *
     * @return Animal
     */
    public function setDayOfBirth($dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;
        $this->setAge();

        return $this;
    }

    /**
     * Get dayOfBirth
     *
     * @return \DateTime
     */
    public function getDayOfBirth()
    {
        return $this->dayOfBirth;
    }

    /**
     * Set admissionDate
     *
     * @param \DateTime $admissionDate
     *
     * @return Animal
     */
    public function setAdmissionDate($admissionDate)
    {
        $this->admissionDate = $admissionDate;

        return $this;
    }

    /**
     * Get admissionDate
     *
     * @return \DateTime
     */
    public function getAdmissionDate()
    {
        return $this->admissionDate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Animal
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set colour
     *
     * @param string $colour
     *
     * @return Animal
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set characteristics
     *
     * @param string $characteristics
     *
     * @return Animal
     */
    public function setCharacteristics($characteristics)
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * Get characteristics
     *
     * @return string
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }

    /**
     * Set medicalProblems
     *
     * @param string $medicalProblems
     *
     * @return Animal
     */
    public function setMedicalProblems($medicalProblems)
    {
        $this->medicalProblems = $medicalProblems;

        return $this;
    }

    /**
     * Get medicalProblems
     *
     * @return string
     */
    public function getMedicalProblems()
    {
        return $this->medicalProblems;
    }

    /**
     * Set compatibleChildrenBelow10y
     *
     * @param boolean $compatibleChildrenBelow10y
     *
     * @return Animal
     */
    public function setCompatibleChildrenBelow10y($compatibleChildrenBelow10y)
    {
        $this->compatibleChildrenBelow10y = $compatibleChildrenBelow10y;

        return $this;
    }

    /**
     * Get compatibleChildrenBelow10y
     *
     * @return bool
     */
    public function getCompatibleChildrenBelow10y()
    {
        return $this->compatibleChildrenBelow10y;
    }

    /**
     * Set compatibleChildrenAbove10y
     *
     * @param boolean $compatibleChildrenAbove10y
     *
     * @return Animal
     */
    public function setCompatibleChildrenAbove10y($compatibleChildrenAbove10y)
    {
        $this->compatibleChildrenAbove10y = $compatibleChildrenAbove10y;

        return $this;
    }

    /**
     * Get compatibleChildrenAbove10y
     *
     * @return bool
     */
    public function getCompatibleChildrenAbove10y()
    {
        return $this->compatibleChildrenAbove10y;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Animal
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
     * Set outsideAnimal
     *
     * @param string $outsideAnimal
     *
     * @return Animal
     */
    public function setOutsideAnimal($outsideAnimal)
    {
        $this->outsideAnimal = $outsideAnimal;

        return $this;
    }

    /**
     * Get outsideAnimal
     *
     * @return string
     */
    public function getOutsideAnimal()
    {
        return $this->outsideAnimal;
    }

    /**
     * Set knownAggression
     *
     * @param string $knownAggression
     *
     * @return Animal
     */
    public function setKnownAggression($knownAggression)
    {
        $this->knownAggression = $knownAggression;

        return $this;
    }

    /**
     * Get knownAggression
     *
     * @return string
     */
    public function getKnownAggression()
    {
        return $this->knownAggression;
    }

    /**
     * Add status
     *
     * @param Status $status
     *
     * @return Animal
     */
    public function addStatus(Status $status)
    {
        $this->status[] = $status;

        return $this;
    }

    /**
     * Remove status
     *
     * @param Status $status
     */
    public function removeStatus(Status $status)
    {
        $this->status->removeElement($status);
    }

    /**
     * Get status
     *
     * @return Collection
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Checks if the animal has no current status for the statemachine
     */
    public function checkNoStatus()
    {
        if ($this->getStatus()->isEmpty()) {
            return true;
        }

        return false;
    }

    /**
     * Add picture
     *
     * @param Picture $picture
     *
     * @return Animal
     */
    public function addPicture(Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param Picture $picture
     */
    public function removePicture(Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        // If you change this, change the frontend animal search as well
        if ($this->age == 0) {
            return 1;
        }
        return $this->age;
    }

    /**
     * Set Age
     */
    public function setAge()
    {
        $now = new DateTime();
        $interval = $now->diff($this->dayOfBirth);

        $this->age = $interval->y;
    }

    /**
     * @return boolean
     */
    public function isNotChipped()
    {
        return $this->notChipped;
    }

    /**
     * @param boolean $notChipped
     */
    public function setNotChipped(bool $notChipped)
    {
        $this->notChipped = $notChipped;
    }

    /**
     * @return string
     */
    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    /**
     * @param string $passportNumber
     */
    public function setPassportNumber(string $passportNumber)
    {
        $this->passportNumber = $passportNumber;
    }

    /**
     * @return boolean
     */
    public function isVisiblePublic()
    {
        return $this->visiblePublic;
    }

    /**
     * @param boolean $visiblePublic
     */
    public function setVisiblePublic(bool $visiblePublic)
    {
        $this->visiblePublic = $visiblePublic;
    }

    /**
     * @return boolean
     */
    public function isEscapesAlot()
    {
        return $this->escapesAlot;
    }

    /**
     * @param boolean $escapesAlot
     */
    public function setEscapesAlot(bool $escapesAlot)
    {
        $this->escapesAlot = $escapesAlot;
    }

    /**
     * @return boolean
     */
    public function isCompatibleOldPeople()
    {
        return $this->compatibleOldPeople;
    }

    /**
     * @param boolean $compatibleOldPeople
     */
    public function setCompatibleOldPeople(bool $compatibleOldPeople)
    {
        $this->compatibleOldPeople = $compatibleOldPeople;
    }

    /**
     * @return boolean
     */
    public function isCompatibleChildrenAbove7y()
    {
        return $this->compatibleChildrenAbove7y;
    }

    /**
     * @param boolean $compatibleChildrenAbove7y
     */
    public function setCompatibleChildrenAbove7y(bool $compatibleChildrenAbove7y)
    {
        $this->compatibleChildrenAbove7y = $compatibleChildrenAbove7y;
    }

    /**
     * @return boolean
     */
    public function isCompatibleChildrenBelow7y()
    {
        return $this->compatibleChildrenBelow7y;
    }

    /**
     * @param boolean $compatibleChildrenBelow7y
     */
    public function setCompatibleChildrenBelow7y(bool $compatibleChildrenBelow7y)
    {
        $this->compatibleChildrenBelow7y = $compatibleChildrenBelow7y;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId(string $facebookId)
    {
        $this->facebookId = $facebookId;
    }


    /**
     * Get notChipped
     *
     * @return boolean
     */
    public function getNotChipped()
    {
        return $this->notChipped;
    }

    /**
     * Get visiblePublic
     *
     * @return boolean
     */
    public function getVisiblePublic()
    {
        return $this->visiblePublic;
    }

    /**
     * Get escapesAlot
     *
     * @return boolean
     */
    public function getEscapesAlot()
    {
        return $this->escapesAlot;
    }

    /**
     * Get compatibleOldPeople
     *
     * @return boolean
     */
    public function getCompatibleOldPeople()
    {
        return $this->compatibleOldPeople;
    }

    /**
     * Get compatibleChildrenAbove7y
     *
     * @return boolean
     */
    public function getCompatibleChildrenAbove7y()
    {
        return $this->compatibleChildrenAbove7y;
    }

    /**
     * Get compatibleChildrenBelow7y
     *
     * @return boolean
     */
    public function getCompatibleChildrenBelow7y()
    {
        return $this->compatibleChildrenBelow7y;
    }

    /**
     * Add task
     *
     * @param Task $task
     *
     * @return Animal
     */
    public function addTask(Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param Task $task
     */
    public function removeTask(Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param Collection $tasks
     * @return bool
     */
    public function openTasks(Collection $tasks)
    {
        $result = false;
        foreach ($tasks as $task) {
            if ($task->getIsComplete() == false) {
                $result = true;
                break;
            }
        }

        if ($result == true) {
            return true;
        }
    }

    /**
     * @return NoState|mixed
     */
    public function getActiveState()
    {
        if ($this->getStatus()->isEmpty()) {
            return new NoState(new AnimalStateMachine());
        }

        foreach ($this->getStatus() as $state) {
            if (!$state->isArchived()) {
                return $state;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getDayLocation()
    {
        return $this->dayLocation;
    }

    /**
     * @param mixed $dayLocation
     */
    public function setDayLocation($dayLocation)
    {
        $this->dayLocation = $dayLocation;
    }

    /**
     * @return mixed
     */
    public function getNightLocation()
    {
        return $this->nightLocation;
    }

    /**
     * @param mixed $nightLocation
     */
    public function setNightLocation($nightLocation)
    {
        $this->nightLocation = $nightLocation;
    }

    /**
     * Add action
     *
     * @param Action $action
     *
     * @return Animal
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param Action $action
     */
    public function removeAction(Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function hasOpenActions()
    {
        if (!$this->getActions()->isEmpty()) {
            foreach ($this->getActions() as $action) {
                if (!$action->isCompleted()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getAnimalType() : string
    {
        if ($this->isKitten()) {
            return 'Kitten';
        }
        if ($this->isCat()) {
            return 'Cat';
        }
        if ($this->isDog()) {
            return 'Dog';
        }
        if ($this->isPuppy()) {
            return 'Puppy';
        }

        return 'Unknown';
    }

    public function isKitten() : bool
    {
        if (($this instanceof Cat) && ($this->isCurrentlyAKitten())) {
            return true;
        }

        return false;
    }

    public function isCat() : bool
    {
        if (($this instanceof Cat) && ($this->isCurrentlyACat())) {
            return true;
        }

        return false;
    }

    public function isPuppy() : bool
    {
        if (($this instanceof Dog) && ($this->isCurrentlyADog())) {
            return true;
        }

        return false;
    }

    public function isDog() : bool
    {
        if (($this instanceof Dog) && ($this->isCurrentlyADog())) {
            return true;
        }

        return false;
    }
}
