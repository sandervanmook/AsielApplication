<?php

namespace Asiel\EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Asiel\EmployeeBundle\Repository\UserRepository")
 * @UniqueEntity("username", message="Gebruikersnaam is al in gebruik")
 * @UniqueEntity("email", message="Emailadres is al in gebruik")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=72)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email(
     *     message="Dit is geen geldig email adres",
     *     checkMX= true,
     *     checkHost= true,
     * )
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Dit veld mag niet leeg zijn")
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
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_phone", type="string", length=12, nullable=true)
     */
    private $mobilePhone;

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
     * @ORM\Column(name="zipcode", type="string", length=8, nullable=false)
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start_contract", type="date", nullable=true)
     */
    private $startContract;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end_contract", type="date", nullable=true)
     */
    private $endContract;

    /**
     * @var string
     *
     * @ORM\Column(name="reason_end_contract", type="text", nullable=true)
     */
    private $reasonEndContract;

    /**
     * @var string
     *
     * @ORM\Column(name="emergency_contact", type="string", length=255, nullable=true)
     */
    private $emergencyContact;

    /**
     * @var string
     *
     * @ORM\Column(name="emergency_contact_phone", type="string", length=50, nullable=true)
     */
    private $emergencyContactPhone;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="text")
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="Asiel\EmployeeBundle\Entity\User\UserPicture", mappedBy="user")
     */
    private $picture;

    public function __construct()
    {
    }

    /**
     * Interface methods
     */
    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getRoles() : array
    {
        $rolesAsArray = explode(',', $this->roles);

        // Remove empty roles (the ',' at the end of the string)
        $cleanArray = array_filter($rolesAsArray);

        return $cleanArray;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $rolesAsString = implode(',', $roles);

        $this->roles = $rolesAsString;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
        // TODO: Implement isAccountNonExpired() method.
    }

    public function isAccountNonLocked()
    {
        return true;
        // TODO: Implement isAccountNonLocked() method.
    }

    public function isCredentialsNonExpired()
    {
        return true;
        // TODO: Implement isCredentialsNonExpired() method.
    }

    public function isEnabled()
    {
        return $this->isActive;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return ucfirst($this->username);
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getCitizenServiceNumber()
    {
        return $this->citizenServiceNumber;
    }

    /**
     * @param string $citizenServiceNumber
     */
    public function setCitizenServiceNumber(string $citizenServiceNumber)
    {
        $this->citizenServiceNumber = $citizenServiceNumber;
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
    public function setDayOfBirth(\DateTime $dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param string $mobilePhone
     */
    public function setMobilePhone(string $mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return \DateTime
     */
    public function getStartContract()
    {
        return $this->startContract;
    }

    /**
     * @param \DateTime $startContract
     */
    public function setStartContract(\DateTime $startContract)
    {
        $this->startContract = $startContract;
    }

    /**
     * @return \DateTime
     */
    public function getEndContract()
    {
        return $this->endContract;
    }

    /**
     * @param \DateTime $endContract
     */
    public function setEndContract(\DateTime $endContract)
    {
        $this->endContract = $endContract;
    }

    /**
     * @return string
     */
    public function getReasonEndContract()
    {
        return $this->reasonEndContract;
    }

    /**
     * @param string $reasonEndContract
     */
    public function setReasonEndContract(string $reasonEndContract)
    {
        $this->reasonEndContract = $reasonEndContract;
    }

    /**
     * @return string
     */
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }

    /**
     * @param string $emergencyContact
     */
    public function setEmergencyContact(string $emergencyContact)
    {
        $this->emergencyContact = $emergencyContact;
    }

    /**
     * @return string
     */
    public function getEmergencyContactPhone()
    {
        return $this->emergencyContactPhone;
    }

    /**
     * @param string $emergencyContactPhone
     */
    public function setEmergencyContactPhone(string $emergencyContactPhone)
    {
        $this->emergencyContactPhone = $emergencyContactPhone;
    }

    /**
     * Set picture
     *
     * @param UserPicture $picture
     *
     * @return User
     */
    public function setPicture(UserPicture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return UserPicture
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
