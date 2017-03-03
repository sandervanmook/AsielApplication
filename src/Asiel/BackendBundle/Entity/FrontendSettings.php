<?php

namespace Asiel\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FrontendSettings
 *
 * @ORM\Table(name="backend_frontend_settings")
 * @ORM\Entity(repositoryClass="Asiel\BackendBundle\Repository\FrontendSettingsRepository")
 */
class FrontendSettings
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="housenumber", type="string", length=5)
     */
    private $housenumber;

    /**
     * @var string
     *
     * @ORM\Column(name="municipality", type="string", length=150)
     */
    private $municipality;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=10)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="coc_number", type="string", length=20)
     */
    private $cocNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_filename", type="string", length=255)
     */
    private $logoFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="about_us", type="text", nullable=false)
     */
    private $aboutUs;

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
     * @return FrontendSettings
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
     * Set address
     *
     * @param string $address
     *
     * @return FrontendSettings
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
     * Set housenumber
     *
     * @param string $housenumber
     *
     * @return FrontendSettings
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;

        return $this;
    }

    /**
     * Get housenumber
     *
     * @return string
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * Set municipality
     *
     * @param string $municipality
     *
     * @return FrontendSettings
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
     * Set phone
     *
     * @param string $phone
     *
     * @return FrontendSettings
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
     * Set email
     *
     * @param string $email
     *
     * @return FrontendSettings
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
     * Set cocNumber
     *
     * @param string $cocNumber
     *
     * @return FrontendSettings
     */
    public function setCocNumber($cocNumber)
    {
        $this->cocNumber = $cocNumber;

        return $this;
    }

    /**
     * Get cocNumber
     *
     * @return string
     */
    public function getCocNumber()
    {
        return $this->cocNumber;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return FrontendSettings
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return FrontendSettings
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set logoFilename
     *
     * @param string $logoFilename
     *
     * @return FrontendSettings
     */
    public function setLogoFilename($logoFilename)
    {
        $this->logoFilename = $logoFilename;

        return $this;
    }

    /**
     * Get logoFilename
     *
     * @return string
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
    }

    public function getZipcode() : string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getAboutUs(): string
    {
        return $this->aboutUs;
    }

    /**
     * @param string $aboutUs
     */
    public function setAboutUs(string $aboutUs)
    {
        $this->aboutUs = $aboutUs;
    }



}

