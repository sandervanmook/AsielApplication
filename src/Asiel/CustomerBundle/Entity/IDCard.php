<?php

namespace Asiel\CustomerBundle\Entity;

use Asiel\CustomerBundle\Entity\PrivateCustomer;
use Doctrine\ORM\Mapping as ORM;

/**
 * IDCard
 *
 * @ORM\Table(name="customer_id_card")
 * @ORM\Entity(repositoryClass="Asiel\CustomerBundle\Repository\IDCardRepository")
 */
class IDCard
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
     * @ORM\Column(name="nationalnumber", type="string", length=50)
     */
    private $nationalnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="day_of_birth", type="string", length=8)
     */
    private $dayOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="middlenames", type="string", length=255, nullable=true)
     */
    private $middlenames;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=255)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="placeofbirth", type="string", length=255)
     */
    private $placeofbirth;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="text", nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="documenttype", type="string", length=255)
     */
    private $documenttype;

    /**
     * @var string
     *
     * @ORM\Column(name="cardnumber", type="string", length=30)
     */
    private $cardnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="chipnumber", type="string", length=255)
     */
    private $chipnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="validitydatebegin", type="string", length=10)
     */
    private $validitydatebegin;

    /**
     * @var string
     *
     * @ORM\Column(name="validitydateend", type="string", length=10)
     */
    private $validitydateend;

    /**
     * @var string
     *
     * @ORM\Column(name="deliverymunicipality", type="string", length=255)
     */
    private $deliverymunicipality;

    /**
     * @var string
     *
     * @ORM\Column(name="streetandnumber", type="string", length=255)
     */
    private $streetandnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=10)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="municipality", type="string", length=255)
     */
    private $municipality;

    /**
     * @ORM\OneToOne(targetEntity="Asiel\CustomerBundle\Entity\PrivateCustomer", inversedBy="idCard")
     */
    private $privateCustomer;

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
     * Set nationalnumber
     *
     * @param string $nationalnumber
     *
     * @return IDCard
     */
    public function setNationalnumber($nationalnumber)
    {
        $this->nationalnumber = $nationalnumber;

        return $this;
    }

    /**
     * Get nationalnumber
     *
     * @return string
     */
    public function getNationalnumber()
    {
        return $this->nationalnumber;
    }

    /**
     * Set dayOfBirth
     *
     * @param string $dayOfBirth
     *
     * @return IDCard
     */
    public function setDayOfBirth($dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;

        return $this;
    }

    /**
     * Get dayOfBirth
     *
     * @return string
     */
    public function getDayOfBirth()
    {
        return $this->dayOfBirth;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return IDCard
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
     * Set name
     *
     * @param string $name
     *
     * @return IDCard
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return IDCard
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
     * Set middlenames
     *
     * @param string $middlenames
     *
     * @return IDCard
     */
    public function setMiddlenames($middlenames)
    {
        $this->middlenames = $middlenames;

        return $this;
    }

    /**
     * Get middlenames
     *
     * @return string
     */
    public function getMiddlenames()
    {
        return $this->middlenames;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return IDCard
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set placeofbirth
     *
     * @param string $placeofbirth
     *
     * @return IDCard
     */
    public function setPlaceofbirth($placeofbirth)
    {
        $this->placeofbirth = $placeofbirth;

        return $this;
    }

    /**
     * Get placeofbirth
     *
     * @return string
     */
    public function getPlaceofbirth()
    {
        return $this->placeofbirth;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return IDCard
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set documenttype
     *
     * @param string $documenttype
     *
     * @return IDCard
     */
    public function setDocumenttype($documenttype)
    {
        $this->documenttype = $documenttype;

        return $this;
    }

    /**
     * Get documenttype
     *
     * @return string
     */
    public function getDocumenttype()
    {
        return $this->documenttype;
    }

    /**
     * Set cardnumber
     *
     * @param string $cardnumber
     *
     * @return IDCard
     */
    public function setCardnumber($cardnumber)
    {
        $this->cardnumber = $cardnumber;

        return $this;
    }

    /**
     * Get cardnumber
     *
     * @return string
     */
    public function getCardnumber()
    {
        return $this->cardnumber;
    }

    /**
     * Set chipnumber
     *
     * @param string $chipnumber
     *
     * @return IDCard
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
     * Set validitydatebegin
     *
     * @param string $validitydatebegin
     *
     * @return IDCard
     */
    public function setValiditydatebegin($validitydatebegin)
    {
        $this->validitydatebegin = $validitydatebegin;

        return $this;
    }

    /**
     * Get validitydatebegin
     *
     * @return string
     */
    public function getValiditydatebegin()
    {
        return $this->validitydatebegin;
    }

    /**
     * Set validitydateend
     *
     * @param string $validitydateend
     *
     * @return IDCard
     */
    public function setValiditydateend($validitydateend)
    {
        $this->validitydateend = $validitydateend;

        return $this;
    }

    /**
     * Get validitydateend
     *
     * @return string
     */
    public function getValiditydateend()
    {
        return $this->validitydateend;
    }

    /**
     * Set deliverymunicipality
     *
     * @param string $deliverymunicipality
     *
     * @return IDCard
     */
    public function setDeliverymunicipality($deliverymunicipality)
    {
        $this->deliverymunicipality = $deliverymunicipality;

        return $this;
    }

    /**
     * Get deliverymunicipality
     *
     * @return string
     */
    public function getDeliverymunicipality()
    {
        return $this->deliverymunicipality;
    }

    /**
     * Set streetandnumber
     *
     * @param string $streetandnumber
     *
     * @return IDCard
     */
    public function setStreetandnumber($streetandnumber)
    {
        $this->streetandnumber = $streetandnumber;

        return $this;
    }

    /**
     * Get streetandnumber
     *
     * @return string
     */
    public function getStreetandnumber()
    {
        return $this->streetandnumber;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return IDCard
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set municipality
     *
     * @param string $municipality
     *
     * @return IDCard
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
     * Set privateCustomer
     *
     * @param PrivateCustomer $privateCustomer
     *
     * @return IDCard
     */
    public function setPrivateCustomer(PrivateCustomer $privateCustomer = null)
    {
        $this->privateCustomer = $privateCustomer;

        return $this;
    }

    /**
     * Get privateCustomer
     *
     * @return PrivateCustomer
     */
    public function getPrivateCustomer()
    {
        return $this->privateCustomer;
    }
}
