<?php

namespace Asiel\CustomerBundle\Entity;

use Asiel\CustomerBundle\Entity\IDCard;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * PrivateCustomer
 *
 * @ORM\Table(name="customer_private")
 * @ORM\Entity(repositoryClass="Asiel\CustomerBundle\Repository\PrivateCustomerRepository")
 */
class PrivateCustomer extends Customer implements TypeInterface
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
     * @ORM\OneToOne(targetEntity="Asiel\CustomerBundle\Entity\IDCard", mappedBy="privateCustomer")
     */
    private $idCard;

    public function getClassName() : string
    {
        return 'PrivateCustomer';
    }

    public function getId()
    {
        //return $this->id;
        return parent::getId();
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return PrivateCustomer
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
     * @return PrivateCustomer
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
     * Set citizenServiceNumber
     *
     * @param string $citizenServiceNumber
     *
     * @return PrivateCustomer
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
     * Set dayOfBirth
     *
     * @param \DateTime $dayOfBirth
     *
     * @return PrivateCustomer
     */
    public function setDayOfBirth($dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;

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
     * Set email
     *
     * @param string $email
     *
     * @return PrivateCustomer
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
     * @return PrivateCustomer
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
     * @return PrivateCustomer
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
     * @return PrivateCustomer
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
     * Set municipality
     *
     * @param string $municipality
     *
     * @return PrivateCustomer
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
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return PrivateCustomer
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
     * Set country
     *
     * @param string $country
     *
     * @return PrivateCustomer
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
     * @return PrivateCustomer
     */
    public function setBlacklisted($blacklisted)
    {
        $this->blacklisted = $blacklisted;

        return $this;
    }

    /**
     * Get blacklisted
     *
     * @return boolean
     */
    public function getBlacklisted()
    {
        return $this->blacklisted;
    }

    /**
     * Set blacklistedReason
     *
     * @param string $blacklistedReason
     *
     * @return PrivateCustomer
     */
    public function setBlacklistedReason($blacklistedReason)
    {
        $this->blacklistedReason = $blacklistedReason;

        return $this;
    }

    /**
     * Get blacklistedReason
     *
     * @return string
     */
    public function getBlacklistedReason()
    {
        return $this->blacklistedReason;
    }

    /**
     * Set idCard
     *
     * @param IDCard $idCard
     *
     * @return PrivateCustomer
     */
    public function setIdCard(IDCard $idCard = null)
    {
        $this->idCard = $idCard;

        return $this;
    }

    /**
     * Get idCard
     *
     * @return IDCard
     */
    public function getIdCard()
    {
        return $this->idCard;
    }
}
