<?php

namespace Asiel\CustomerBundle\Entity;

use Asiel\AnimalBundle\Entity\StatusType\Abandoned;
use Asiel\AnimalBundle\Entity\StatusType\Adopted;
use Asiel\AnimalBundle\Entity\StatusType\Found;
use Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner;
use Asiel\BookkeepingBundle\Entity\Action;
use Asiel\BookkeepingBundle\Entity\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="Asiel\CustomerBundle\Repository\CustomerRepository")
 */
class Customer
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
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="citizen_service_number", type="string", length=255, nullable=false)
     * \@Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $citizenServiceNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day_of_birth", type="date")
     * @Assert\LessThanOrEqual("today", message = "Datum moet in het verleden zijn")
     */
    private $dayOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message="Dit is geen geldig email adres",
     *     checkMX= true,
     *     checkHost= true,
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=5, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="municipality", type="string", length=255, nullable=false)
     */
    private $municipality;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=15, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $country;

    /**
     * @var bool
     *
     * @ORM\Column(name="blacklisted", type="boolean")
     */
    private $blacklisted;

    /**
     * @var string
     *
     * @ORM\Column(name="blacklisted_reason", type="text", nullable=true)
     */
    private $blacklistedReason;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Adopted", mappedBy="customer")
     */
    private $adoptedPets;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Found", mappedBy="foundBy")
     */
    private $foundAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner", mappedBy="owner")
     */
    private $ownsAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\AnimalBundle\Entity\StatusType\Abandoned", mappedBy="abandonedBy")
     */
    private $abandonedAnimals;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Transaction", mappedBy="customer")
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity="Asiel\BookkeepingBundle\Entity\Action", mappedBy="customer")
     */
    private $actions;

    public function __construct()
    {
        $this->adoptedPets = new ArrayCollection();
        $this->foundAnimals = new ArrayCollection;
        $this->ownsAnimals = new ArrayCollection;
        $this->abandonedAnimals = new ArrayCollection;
        $this->transactions = new ArrayCollection;
        $this->actions = new ArrayCollection;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }

    /**
     * Used by registration form to choose who found the pet.
     * @return string
     */
    public function foundByName()
    {
        return sprintf('%s %s', $this->lastname, $this->dayOfBirth->format('d-m-Y'));
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Customer
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Customer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return \DateTime
     */
    public function getDayOfBirth()
    {
        return $this->dayOfBirth;
    }

    /**
     * @param \DateTime $dayOfBirth
     */
    public function setDayOfBirth($dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;
    }

    /**
     * Set citizenServiceNumber
     *
     * @param string $citizenServiceNumber
     *
     * @return Customer
     */
    public function setCitizenServiceNumber($citizenServiceNumber)
    {
        $this->citizenServiceNumber = $citizenServiceNumber;

        return $this;
    }

    /**
     * Get citizenServiceNumber
     *
     * @return string
     */
    public function getCitizenServiceNumber()
    {
        return $this->citizenServiceNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     *
     * @return Customer
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Customer
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Customer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set blacklisted
     *
     * @param boolean $blacklisted
     *
     * @return Customer
     */
    public function setBlacklisted($blacklisted)
    {
        $this->blacklisted = $blacklisted;

        return $this;
    }

    /**
     * Get blacklisted
     *
     * @return bool
     */
    public function getBlacklisted()
    {
        return $this->blacklisted;
    }

    /**
     * Add adoptedPet
     *
     * @param Adopted $adoptedPet
     *
     * @return Customer
     */
    public function addAdoptedPet(Adopted $adoptedPet)
    {
        $this->adoptedPets[] = $adoptedPet;

        return $this;
    }

    /**
     * Remove adoptedPet
     *
     * @param Adopted $adoptedPet
     */
    public function removeAdoptedPet(Adopted $adoptedPet)
    {
        $this->adoptedPets->removeElement($adoptedPet);
    }

    /**
     * Get adoptedPets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdoptedPets()
    {
        return $this->adoptedPets;
    }

    /**
     * Add ownsAnimal
     *
     * @param ReturnedOwner $ownsAnimal
     *
     * @return Customer
     */
    public function addOwnsAnimal(ReturnedOwner $ownsAnimal)
    {
        $this->ownsAnimals[] = $ownsAnimal;

        return $this;
    }

    /**
     * Remove ownsAnimal
     *
     * @param ReturnedOwner $ownsAnimal
     */
    public function removeOwnsAnimal(ReturnedOwner $ownsAnimal)
    {
        $this->ownsAnimals->removeElement($ownsAnimal);
    }

    /**
     * Get ownsAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOwnsAnimals()
    {
        return $this->ownsAnimals;
    }

    /**
     * Add foundAnimal
     *
     * @param Found $foundAnimal
     *
     * @return Customer
     */
    public function addFoundAnimal(Found $foundAnimal)
    {
        $this->foundAnimals[] = $foundAnimal;

        return $this;
    }

    /**
     * Remove foundAnimal
     *
     * @param Found $foundAnimal
     */
    public function removeFoundAnimal(Found $foundAnimal)
    {
        $this->foundAnimals->removeElement($foundAnimal);
    }

    /**
     * Get foundAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFoundAnimals()
    {
        return $this->foundAnimals;
    }

    /**
     * Add abandonedAnimal
     *
     * @param Abandoned $abandonedAnimal
     *
     * @return Customer
     */
    public function addAbandonedAnimal(Abandoned $abandonedAnimal)
    {
        $this->abandonedAnimals[] = $abandonedAnimal;

        return $this;
    }

    /**
     * Remove abandonedAnimal
     *
     * @param Abandoned $abandonedAnimal
     */
    public function removeAbandonedAnimal(Abandoned $abandonedAnimal)
    {
        $this->abandonedAnimals->removeElement($abandonedAnimal);
    }

    /**
     * Get abandonedAnimals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbandonedAnimals()
    {
        return $this->abandonedAnimals;
    }

    /**
     * @return string
     */
    public function getBlacklistedReason()
    {
        return $this->blacklistedReason;
    }

    /**
     * @param string $blacklistedReason
     */
    public function setBlacklistedReason($blacklistedReason)
    {
        $this->blacklistedReason = $blacklistedReason;
    }

    /**
     * Set municipality
     *
     * @param string $municipality
     *
     * @return Customer
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
     * Add action
     *
     * @param Action $action
     *
     * @return Customer
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

    /**
     * Add transaction
     *
     * @param \Asiel\BookkeepingBundle\Entity\Transaction $transaction
     *
     * @return Customer
     */
    public function addTransaction(\Asiel\BookkeepingBundle\Entity\Transaction $transaction)
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \Asiel\BookkeepingBundle\Entity\Transaction $transaction
     */
    public function removeTransaction(\Asiel\BookkeepingBundle\Entity\Transaction $transaction)
    {
        $this->transactions->removeElement($transaction);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

}
