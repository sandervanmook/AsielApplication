<?php

namespace Asiel\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="Asiel\LocationBundle\Repository\LocationRepository")
 */
class Location
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
     * @var string
     *
     * @ORM\Column(name="animal_type", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $animalType;

    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     *
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set animalType
     *
     * @param string $animalType
     *
     * @return Location
     */
    public function setAnimalType($animalType)
    {
        $this->animalType = $animalType;

        return $this;
    }

    /**
     * Get animalType
     *
     * @return string
     */
    public function getAnimalType()
    {
        return $this->animalType;
    }
}
