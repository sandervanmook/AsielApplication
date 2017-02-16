<?php

namespace Asiel\AnimalBundle\Entity\AnimalType;

use Asiel\AnimalBundle\Entity\Animal;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Cat
 *
 * @ORM\Table(name="cat")
 * @ORM\Entity(repositoryClass="Asiel\AnimalBundle\Repository\AnimalType\CatRepository")
 */
class Cat extends Animal implements TypeInterface
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
     * @ORM\OneToOne(targetEntity="Asiel\AnimalBundle\Entity\Animal")
     */
    private $animal;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $race;

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
        return 'Cat';
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Cat
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
     * Set sterilized
     *
     * @param boolean $sterilized
     *
     * @return Cat
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
     * @return Cat
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
     * @return Cat
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
     * @return Cat
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
     * @return Cat
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
     * @return Cat
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

    /**
     * Set animal
     *
     * @param Animal $animal
     *
     * @return Cat
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

    public function isCurrentlyAKitten() : bool
    {
        if ($this->getAge() <= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isCurrentlyACat() : bool
    {
        if ($this->getAge() >= 2) {
            return true;
        } else {
            return false;
        }
    }
}
