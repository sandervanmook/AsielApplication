<?php

namespace Asiel\AnimalBundle\Entity\AnimalType;

use Asiel\AnimalBundle\Entity\Animal;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dog
 *
 * @ORM\Table(name="dog")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\AnimalType\DogRepository")
 */
class Dog extends Animal implements TypeInterface
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
     * @ORM\Column(name="race", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="known_commands", type="text", nullable=true)
     */
    private $knownCommands;

    /**
     * @var bool
     *
     * @ORM\Column(name="needs_exercise", type="boolean")
     */
    private $needsExercise;

    /**
     * @var string
     *
     * @ORM\Column(name="fur_type", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $furType;

    /**
     * @var bool
     *
     * @ORM\Column(name="sterilized", type="boolean")
     */
    private $sterilized;

    /**
     * @var string
     *
     * @ORM\Column(name="compatible_small_dog", type="text", nullable=true)
     */
    private $compatibleSmallDog;

    /**
     * @var string
     *
     * @ORM\Column(name="compatible_large_dog", type="text", nullable=true)
     */
    private $compatibleLargeDog;

    /**
     * @var string
     *
     * @ORM\Column(name="compatible_cat", type="text", nullable=true)
     */
    private $compatibleCat;

    /**
     * @var string
     *
     * @ORM\Column(name="compatible_other_animals", type="text", nullable=true)
     */
    private $compatibleOtherAnimals;

    /**
     * @var bool
     *
     * @ORM\Column(name="toilet_trained", type="boolean")
     */
    private $toiletTrained;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        //return $this->id;
        return parent::getId();
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return 'Dog';
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Dog
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set knownCommands
     *
     * @param string $knownCommands
     *
     * @return Dog
     */
    public function setKnownCommands($knownCommands)
    {
        $this->knownCommands = $knownCommands;

        return $this;
    }

    /**
     * Get knownCommands
     *
     * @return string
     */
    public function getKnownCommands()
    {
        return $this->knownCommands;
    }

    /**
     * Set needsExercise
     *
     * @param boolean $needsExercise
     *
     * @return Dog
     */
    public function setNeedsExercise($needsExercise)
    {
        $this->needsExercise = $needsExercise;

        return $this;
    }

    /**
     * Get needsExercise
     *
     * @return bool
     */
    public function getNeedsExercise()
    {
        return $this->needsExercise;
    }

    /**
     * Set furType
     *
     * @param string $furType
     *
     * @return Dog
     */
    public function setFurType($furType)
    {
        $this->furType = $furType;

        return $this;
    }

    /**
     * Get furType
     *
     * @return string
     */
    public function getFurType()
    {
        return $this->furType;
    }

    /**
     * Set sterilized
     *
     * @param boolean $sterilized
     *
     * @return Dog
     */
    public function setSterilized($sterilized)
    {
        $this->sterilized = $sterilized;

        return $this;
    }

    /**
     * Get sterilized
     *
     * @return bool
     */
    public function getSterilized()
    {
        return $this->sterilized;
    }

    /**
     * Set compatibleSmallDog
     *
     * @param string $compatibleSmallDog
     *
     * @return Dog
     */
    public function setCompatibleSmallDog($compatibleSmallDog)
    {
        $this->compatibleSmallDog = $compatibleSmallDog;

        return $this;
    }

    /**
     * Get compatibleSmallDog
     *
     * @return string
     */
    public function getCompatibleSmallDog()
    {
        return $this->compatibleSmallDog;
    }

    /**
     * Set compatibleLargeDog
     *
     * @param string $compatibleLargeDog
     *
     * @return Dog
     */
    public function setCompatibleLargeDog($compatibleLargeDog)
    {
        $this->compatibleLargeDog = $compatibleLargeDog;

        return $this;
    }

    /**
     * Get compatibleLargeDog
     *
     * @return string
     */
    public function getCompatibleLargeDog()
    {
        return $this->compatibleLargeDog;
    }

    /**
     * Set compatibleCat
     *
     * @param string $compatibleCat
     *
     * @return Dog
     */
    public function setCompatibleCat($compatibleCat)
    {
        $this->compatibleCat = $compatibleCat;

        return $this;
    }

    /**
     * Get compatibleCat
     *
     * @return string
     */
    public function getCompatibleCat()
    {
        return $this->compatibleCat;
    }

    /**
     * Set compatibleOtherAnimals
     *
     * @param string $compatibleOtherAnimals
     *
     * @return Dog
     */
    public function setCompatibleOtherAnimals($compatibleOtherAnimals)
    {
        $this->compatibleOtherAnimals = $compatibleOtherAnimals;

        return $this;
    }

    /**
     * Get compatibleOtherAnimals
     *
     * @return string
     */
    public function getCompatibleOtherAnimals()
    {
        return $this->compatibleOtherAnimals;
    }

    /**
     * Set toiletTrained
     *
     * @param boolean $toiletTrained
     *
     * @return Dog
     */
    public function setToiletTrained($toiletTrained)
    {
        $this->toiletTrained = $toiletTrained;

        return $this;
    }

    /**
     * Get toiletTrained
     *
     * @return bool
     */
    public function getToiletTrained()
    {
        return $this->toiletTrained;
    }

    public function isCurrentlyAPuppy() : bool
    {
        if ($this->getAge() <= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isCurrentlyADog() : bool
    {
        if ($this->getAge() >= 2) {
            return true;
        } else {
            return false;
        }
    }

}
